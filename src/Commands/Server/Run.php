<?php

namespace Dragoon\Commands\Server;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Runs the Server
 */
class Run extends Command {

    protected function configure () {

        $this->setName('server:run');
        $this->setDescription('Run this Dragoon application as a daemon server.');

        //options
        $this->setOption(
            'daemon',
            'd',
            InputOption::VALUE_NONE,
            'Run as a backgrounded daemon. This only works on Unix platforms with pcntl extension installed.',
            false
        );

        //see this: http://www.re-cycledair.com/php-dark-arts-daemonizing-a-process
        //http://stuporglue.org/writing-a-daemon-with-php/

        //arguments
        //we need IP + Port

    }

    protected function execute () {

        //here we can execute a custom server, thus making PHP it's own web server
        //event driven web SAPI
        //we can use React
        //or we can use Swoole
        //this example will use React as it currently works on Windows
        //Swoole is better for production thought

    }

}