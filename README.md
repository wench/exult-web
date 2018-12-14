[![CodeFactor](https://www.codefactor.io/repository/github/exult/exult-web/badge)](https://www.codefactor.io/repository/github/exult/exult-web)

Quick and dirty guide to our Web-Git
----

- checkout this repository

- change/add stuff there

- commit changes to Git

- in a terminal shell, download a snapshot of the current website with the following command:
    ```
    wget https://github.com/exult/exult-web/archive/master.zip
    ```

- transfer the file over to Exult web space with
    ```
    scp master.zip USER@web.sourceforge.net:/home/project-web/exult
    ```

- [create interactive shell session](https://sourceforge.net/p/forge/documentation/Shell%20Service/):
    ```
    ssh -t USER,exult@shell.sourceforge.net create
    ```

- change dir to our webspace:
    ```
    cd /home/project-web/exult
    ````

- update the webspace with:
    ```
    ./update.sh
    ```

This script updates `/home/project-web/exult/htdocs` with latest Git version, and sets up the correct permissions for all files.

For efficiency reasons, htdocs is a symbolic link to exult-web-master directory.

If you need to modify the `update.sh` script, modify it in git and it will copy itself over.

# **Please do not edit the webspace directly.**
