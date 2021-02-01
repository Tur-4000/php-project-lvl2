[![Actions Status](https://github.com/Tur-4000/php-project-lvl2/workflows/hexlet-check/badge.svg)](https://github.com/Tur-4000/php-project-lvl2/actions)
[![PHP CI](https://github.com/Tur-4000/php-project-lvl2/workflows/PHP%20CI/badge.svg)](https://github.com/Tur-4000/php-project-lvl2/actions)

# GenDiff

Утилита для сравнения двух файлов.

## Setup

```sh
$ git clone https://github.com/Tur-4000/php-project-lvl2.git

$ make install
```

## Run tests

```sh
$ make test
```

## Usage

```sh
gendiff -h

Generate diff

Usage:
  gendiff (-h|--help)
  gendiff (-v|--version)
  gendiff [--format <fmt>] FIRST_FILE SECOND_FILE

Options:
  -h --help                     Show this screen
  -v --version                  Show version
  --format <fmt>                Report format [default: stylish]
```

[![asciicast](https://asciinema.org/a/388341.svg)](https://asciinema.org/a/388341)
