===================
Install with docker
===================

Steps
-----

- Install Docker

  - Linux

    - See https://docs.docker.com/engine/install/

  - Mac

    - Go to https://docs.docker.com/docker-for-mac/install/ and follow the instruction.

- Install docker-compose

  - Linux

    - Go to https://docs.docker.com/compose/install/ and follow the instruction.

  - Mac

    - Docker Desktop for Mac includes Compose along with other Docker apps, so Mac users do not need to install Compose separately. For installation instructions, see Install Docker Desktop on Mac.

- Clone project(only for first install)

  - git clone -b development1 https://github.com/Code-Operative/Reuse.git

- Go to feature/addDocker

  - git checkout -b feature/addDocker
  - git pull origin feature/addDocker

- Go to folder project and build

  - cd Reuse #or custom project folder name.
  - make build

- Go to browser at localhost:250

Commands
--------

- backend server container:

  - make ssh-be
  - make ssh-be-root #root access

- Run and stop containers

  - make run
  - make stop

- Help commands (form more commands)

  - make help

Config xdebug and db manager with phpstorm
---------------------------

  - Go to https://docs.google.com/document/d/1cF5st89t7dRiad_n9sH5d8mYEU4BQAITLAjWIQmGd7s/edit?usp=sharing

Set to dev mode
---------------

  - Set define('_PS_MODE_DEV_', false); #to true in /config/defines.inc.php

Config db
---------

  - Get test db

    - Get test db an rename to prestashop.sql
    - Copy prestashop.sql to db container. Execute "docker cp /path-to-db/prestashop.sql demo-server-db:/home/prestashop.sql"

  - Run prestashop.sql in container
    - In the path of project execute "make ssh-db-root" to run container shell
    - cd home
    - mysql -u root -p  prestashop < prestashop.sql

  - Config parameters.php
   
    +--------------------------------------+
    | 'database_host' => 'demo-server-db', |
    +--------------------------------------+
    | 'database_port' => '3306',           |
    +--------------------------------------+
    | 'database_name' => 'prestashop',     |
    +--------------------------------------+
    | 'database_user' => 'root',           |
    +--------------------------------------+
    | 'database_password' => 'root',       |
    +--------------------------------------+
    | 'database_prefix' => 'psrn\_',       |
    +--------------------------------------+
    | 'database_engine' => 'InnoDB',       |
    +--------------------------------------+
    

