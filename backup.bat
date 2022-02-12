@echo off
REM ----------------------------------------------------------------
REM Create a directory to save mysql backup files if not already exists REM ----------------------------------------------------------------

IF NOT EXIST "C:\MYSQLBACKUPS" mkdir C:\MYSQLBACKUPS

REM ----------------------------------------------------------------
REM append date and time to mysqldump files
REM ----------------------------------------------------------------

SET dt=%date:~-4%_%date:~3,2%_%date:~0,2%_%time:~0,2%_%time:~3,2%_%time:~6,2%


set bkupfilename=%dt%.sql

REM ----------------------------------------------------------------
REM Display some message on the screen about the backup
REM ----------------------------------------------------------------

 

ECHO Starting Backup of MySQL Database
ECHO Backup is going to save in C:\MYSQLBACKUPS\ folder.
ECHO Please wait ...

REM ----------------------------------------------------------------
REM mysqldump backup command. append date and time in filename
REM ----------------------------------------------------------------

"C:\xampp\mysql\bin\mysqldump.exe"  --routines -u andylelli -pGinogino1 netloftc_beeks > C:\MYSQLBACKUPS\"mysqldb_%bkupfilename%"

REM ----------------------------------------------------------------
REM delete mysqldump backups older than 60 days
REM ----------------------------------------------------------------

ECHO.
ECHO Trying to find and delete backups older than 60 days if found.
ECHO And the result is:
forfiles /p C:\MYSQLBACKUPS /s /m *.* /d -60 /c "cmd /c del @file"

ECHO.
ECHO Backup completed!
ECHO Backup saved in C:\MYSQLBACKUPS\
ECHO Thank You for backing up!
ECHO.
EXIT