[![CodeFactor](https://www.codefactor.io/repository/github/exult/exult-web/badge)](https://www.codefactor.io/repository/github/exult/exult-web)

Quick and dirty guide to our Web-Git
----

- checkout this repository

- change/add stuff there

- commit changes to Git

- [create interactive shell session](https://sourceforge.net/p/forge/documentation/Shell%20Service/):
    ```
    ssh -t USER,exult@shell.sourceforge.net create
    ```

- change dir to our webspace:
    ```
    cd /home/project-web/exult/htdocs
    ````

- update the webspace with:
    ```
    ./update.sh
    ```

This script updates `/home/project-web/exult/htdocs` with latest Git version, and sets up the correct permissions for all files.

Please do not edit the webspace directly.
