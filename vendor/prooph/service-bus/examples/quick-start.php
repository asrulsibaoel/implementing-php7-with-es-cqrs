<?php
/*
 * This file is part of the prooph/php-service-bus.
 * (c) Alexander Miertsch <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 03/15/14 - 22:34
 */

namespace {
    require_once __DIR__ . '/../vendor/autoload.php';
}

namespace Prooph\ServiceBus\Example\Command {

    use Prooph\Common\Messaging\Command;

    class EchoText extends Command
    {
        /**
         * @var string
         */
        private $text;

        public function __construct($text)
        {
            $this->text = $text;
        }

        public function getText()
        {
            return $this->text;
        }

        /**
         * Return message payload as array
         *
         * @return array
         */
        public function payload()
        {
            return ['text' => $this->text];
        }

        /**
         * This method is called when message is instantiated named constructor fromArray
         *
         * @param array $payload
         * @return void
         */
        protected function setPayload(array $payload)
        {
            $this->text = $payload['text'];
        }
    }
}

namespace {
    use Prooph\ServiceBus\CommandBus;
    use Prooph\ServiceBus\Example\Command\EchoText;
    use Prooph\ServiceBus\Plugin\Router\CommandRouter;

    $commandBus = new CommandBus();

    $router = new CommandRouter();

    //Register a callback as CommandHandler for the EchoText command
    $router->route('Prooph\ServiceBus\Example\Command\EchoText')
        ->to(function (EchoText $aCommand) {
            echo $aCommand->getText();
        });

    //Expand command bus with the router plugin
    $commandBus->utilize($router);

    //We create a new Command
    $echoText = new EchoText('It works');

    //... and dispatch it
    $commandBus->dispatch($echoText);

    //Output should be: It works
}
