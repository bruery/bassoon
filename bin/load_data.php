<?php

/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

if (!is_file('composer.json')) {
    throw new \RuntimeException('This script must be started from the project root folder');
}

$rootDir = __DIR__ . '/..';

require_once __DIR__ . '/../app/bootstrap.php.cache';

use Symfony\Component\Console\Output\OutputInterface;

// reset data
$fs = new \Symfony\Component\Filesystem\Filesystem;
$output = new \Symfony\Component\Console\Output\ConsoleOutput();

// does the parent directory have a parameters.yml file
if (is_file(__DIR__.'/../../parameters.demo.yml')) {
    $fs->copy(__DIR__.'/../../parameters.demo.yml', __DIR__.'/../app/config/parameters.yml', true);
}

if (!is_file(__DIR__.'/../app/config/parameters.yml')) {
    $output->writeln('<error>no default apps/config/parameters.yml file</error>');

    exit(1);
}

/**
 * @param $commands
 * @param \Symfony\Component\Console\Output\ConsoleOutput $output
 *
 * @return boolean
 */
function execute_commands($commands, $output)
{
    foreach($commands as $command) {
        $output->writeln(sprintf('<info>Executing : </info> %s', $command));
        $p = new \Symfony\Component\Process\Process($command);
        $p->setTimeout(null);
        $p->run(function($type, $data) use ($output) {
            $output->write($data, false, OutputInterface::VERBOSITY_NORMAL);
        });

        if (!$p->isSuccessful()) {
            return false;
        }

        $output->writeln("");
    }

    return true;
}

// find out the default php runtime
$bin = 'php';

if (defined('PHP_BINARY')) {
    $bin = PHP_BINARY;
}

$output->writeln("<info>Resetting demo</info>");

$fs->remove(sprintf('%s/web/uploads/media', $rootDir));
$fs->mkdir(sprintf('%s/web/uploads/media', $rootDir));

$fs->copy(__DIR__.'/../src/AppBundle/DataFixtures/data/robots.txt', __DIR__.'/../web/app/robots.txt', true);

$success = execute_commands(array(
    'rm -rf ./app/cache/*',

    $bin . ' ./app/console cache:warmup --env=prod --no-debug',
    $bin . ' ./app/console cache:create-cache-class --env=prod --no-debug',
    $bin . ' ./app/console doctrine:database:drop --connection=default --if-exists --force',
    $bin . ' ./app/console doctrine:database:drop --connection=audit --if-exists --force',
    $bin . ' ./app/console doctrine:database:drop --connection=timeline --if-exists --force',
    $bin . ' ./app/console doctrine:database:create --connection=default --if-not-exists',
    $bin . ' ./app/console doctrine:database:create --connection=audit --if-not-exists',
    $bin . ' ./app/console doctrine:database:create --connection=timeline --if-not-exists',
    $bin . ' ./app/console audit:schema:create',
    $bin . ' ./app/console doctrine:schema:update --force',
    $bin . ' ./app/console doctrine:schema:update --em=timeline --force',
    $bin . ' ./app/console audit:schema:update',
    $bin . '  -d memory_limit=1024M -d max_execution_time=600 ./app/console doctrine:fixtures:load --verbose --env=dev --no-debug',
    $bin . ' ./app/console assets:install --symlink web',
    $bin . ' ./app/console sonata:admin:setup-acl',
    $bin . '  -d memory_limit=1024M ./app/console sonata:admin:generate-object-acl'
), $output);

if (!$success) {
    $output->writeln('<info>An error occurs when running a command!</info>');

    exit(1);
}

$output->writeln('<info>Done!</info>');

exit(0);