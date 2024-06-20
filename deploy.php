<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@gitlab.com:prog-0485-fgregori/tornsaula.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('3.89.11.166')
    ->set('remote_user', 'pwes')
    ->set('identity_file', '~/.ssh/id_rsa')
    ->set('deploy_path', '~/var/www');

// Hooks

after('deploy:failed', 'deploy:unlock');
