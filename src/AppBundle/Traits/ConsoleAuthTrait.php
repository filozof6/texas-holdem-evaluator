<?php

namespace AppBundle\Traits;

use AppBundle\Constants\Authentication;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

trait ConsoleAuthTrait
{
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    private function authenticate(InputInterface $input, OutputInterface $output)
    {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $question = new Question('<question>Please authenticate:</question> ');
        $question->setHidden(true);
        $question->setHiddenFallback(false);

        $password = $helper->ask($input, $output, $question);

        if ($password === Authentication::PASSWORD) {
            $output->writeln('<info>Password accepted.</info>');
            $output->writeln('');
        } else {
            $output->writeln('<error>You shall not pass!!!</error>');
            die;
        }
    }
}