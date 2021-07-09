===================
Install with docker
===================

Steps
-----

- Clone project(only for first install)

  - git clone https://gitlab.com/renerecalde/prestashop.git

- Go to feature/addDocker

  - git checkout -b feature/addDocker
  - git pull origin feature/addDocker

- Go to folder project and build

  - cd prestashop
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





