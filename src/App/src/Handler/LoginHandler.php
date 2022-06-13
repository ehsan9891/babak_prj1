<?php declare(strict_types=1);

namespace App\Handler;

use App\Service\CacheService;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use PDO;
use PDOException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

class LoginHandler implements RequestHandlerInterface
{

    private TemplateRendererInterface $templateRenderer;
    private UrlHelper $urlHelper;
    /**
     * @var \App\Service\CacheService
     */
    private CacheService $cacheService;

    public function __construct(
        TemplateRendererInterface $templateRenderer,
        UrlHelper $urlHelper,
        CacheService $cacheService
    ) {
        $this->templateRenderer = $templateRenderer;
        $this->urlHelper = $urlHelper;
        $this->cacheService = $cacheService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $viewVariables = [
            'error' => ''
        ];

        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $username = $request->getParsedBody()['username'];
            $password = $request->getParsedBody()['password'];
            $connction = $this->connctToDb();

            if ($connction == null) {
                $viewVariables['error'] = 'login failed';
            } else {
                $sql = 'select * from tbl_user where username = :username and password = :password';
                $stmt = $connction->prepare($sql);
                $stmt->execute(['username' => $username, 'password' => $password]);
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                if (count($stmt->fetchAll()) > 0) {
                    $uuid = Uuid::uuid4();
                    $this->cacheService->getStorage()->addItem($uuid . 'isAdmin', true);
                    setcookie('userHash', $uuid->toString());
                    return new RedirectResponse($this->urlHelper->generate('admin'));
                }
            }


            $viewVariables['error'] = 'login failed';
        }

        $output = $this->templateRenderer->render('app::login', $viewVariables);
        return new HtmlResponse($output);
    }

    private function connctToDb(): ?PDO
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";

        try {
            $conn = new PDO("mysql:host=$servername;port=8889;dbname=babak_db", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch (PDOException $e) {
            return null;
        }

        return null;
    }
}
