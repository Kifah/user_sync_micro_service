<?php
/**
 * Created by PhpStorm.
 * User: kab
 * Date: 06.05.18
 * Time: 10:08
 */

namespace App\Command;


use RdKafka\Producer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserCreatedCommand extends Command
{

    const USER_CREATED = 'user_created';

    protected function configure()
    {
        $this
            ->setName('app:user-created')
            ->setDescription('User Created event creator')
            ->setHelp(
                'This command allows you simulate a user creation event...'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(
            [
                'User Created Event',
                '============',
                '',
            ]
        );

        $output->writeln('Whoa!');
        $output->writeln('You have just called a user create event ');

        $rk = new Producer();
        $rk->setLogLevel(LOG_DEBUG);
        $rk->addBrokers("event_bus");
        $topic = $rk->newTopic(self::USER_CREATED);
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message payload");



    }

}