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

  - git clone https://github.com/Code-Operative/Reuse.git

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



