<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppInitCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:init')
            ->setDescription('Init application.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Init Application.');
        $user = array(
            'username' => 'admin',
            'password' => 'kaifazhe',
            'roles' => array('ROLE_SUPER_ADMIN'),
        );

        $this->getUserService()->createUser($user);

        $output->writeln([
            "Admin Username: {$user['username']}",
            "Admin Password: {$user['password']}",
        ]);
    }

    protected function getUserService()
    {
        return $this->getApplication()->getKernel()->getContainer()->get('biz')->service('User:UserService');
    }
}
