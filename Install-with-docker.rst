===================
Install with docker
===================

Steps
-----

- Clone project(only for first install)

  - git clone https://github.com/Code-Operative/Reuse.git

- Go to feature/addDocker

  - git checkout -b feature/addDocker
  - git pull origin feature/addDocker

- Go to folder project and build

  - cd Reuse
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

Config xdebug with phpstorm
---------------------------

  - Go to https://docs.google.com/document/d/1cF5st89t7dRiad_n9sH5d8mYEU4BQAITLAjWIQmGd7s/edit?usp=sharing



