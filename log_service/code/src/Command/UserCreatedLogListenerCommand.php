<?php
/**
 * Created by PhpStorm.
 * User: kab
 * Date: 06.05.18
 * Time: 10:25
 */

namespace LoggerApp\Command;



use RdKafka\Conf;
use RdKafka\Consumer;
use RdKafka\TopicConf;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserCreatedLogListenerCommand extends Command
{

    const USER_CREATED = 'user_created';

    protected function configure()
    {
        $this
            ->setName('app:user-created-listener')
            ->setDescription('User Created event listener')
            ->setHelp(
                'This command allows you to listen for user created event...'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(
            [
                'User Created Event Listener',
                '============',
                '',
            ]
        );

        $conf = new Conf();
        $conf->set('group.id', 'myConsumerGroup');
        $rk = new Consumer($conf);
        $rk->addBrokers("event_bus");
        $topicConf = new TopicConf();
        $topicConf->set('auto.commit.interval.ms', 100);
        $topicConf->set('offset.store.method', 'file');
        $topicConf->set('offset.store.path', sys_get_temp_dir());
        $topicConf->set('auto.offset.reset', 'smallest');
        $topic = $rk->newTopic(self::USER_CREATED, $topicConf);
        $topic->consumeStart(0, RD_KAFKA_OFFSET_STORED);

        while (true) {
            $message = $topic->consume(0, 120 * 10000);
            switch ($message->err) {
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    var_dump($message);
                    break;
                case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                    echo "No more messages; will wait for more\n";
                    break;
                case RD_KAFKA_RESP_ERR__TIMED_OUT:
                    echo "Timed out\n";
                    break;
                default:
                    throw new \Exception($message->errstr(), $message->err);
                    break;
            }


        }
    }
}
