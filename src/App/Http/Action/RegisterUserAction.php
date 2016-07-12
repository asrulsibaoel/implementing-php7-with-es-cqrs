<?php


namespace App\Http\Action;

use App\Module\User\Model\Command\RegisterUser;
use App\Module\User\Model\UserId;
use Prooph\Common\Messaging\MessageFactory;
use Prooph\ServiceBus\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rhumsaa\Uuid\Uuid;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\ServerUrlHelper;

final class RegisterUserAction
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var MessageFactory
     */
    private $commandFactory;

    /**
     * @var ServerUrlHelper
     */
    private $urlHelper;
    
    /**
     * @param CommandBus $commandBus
     * @param MessageFactory $commandFactory
     * @param ServerUrlHelper $urlHelper
     */
    public function __construct(CommandBus $commandBus, MessageFactory $commandFactory, ServerUrlHelper $urlHelper)
    {
        $this->commandBus = $commandBus;
        $this->commandFactory = $commandFactory;
        $this->urlHelper = $urlHelper;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $out
    ) : ResponseInterface {
        $data = $request->getParsedBody();
        $data['user_id'] = Uuid::uuid4()->toString();

        $command = $this->commandFactory->createMessageFromArray(
            RegisterUser::class,
            [
                'payload' => $data
            ]
        );

        $this->commandBus->dispatch($command);

        return new RedirectResponse($this->urlHelper->generate('/registered'));
    }
}
