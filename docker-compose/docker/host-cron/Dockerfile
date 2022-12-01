# Pulling Ubuntu image
FROM ubuntu:20.04

# Updating packages and installing cron
RUN apt-get update && apt-get install cron -y 
RUN apt-get -y install python3-pip
RUN pip install ipython
RUN pip install nbformat
RUN pip install pymysql
RUN pip install secure-smtplib
RUN pip install cryptography
RUN apt-get install nano
#RUN sudo apt-get install mysql-server

# Copying script file into the container.
COPY send_email.ipynb .
COPY send_email.sh .

# Giving executable permission to the script file.
RUN chmod 777 send_email.sh
RUN chmod 777 send_email.ipynb

# Adding crontab to the appropiate location
ADD crontab /etc/cron.d/my-cron-file

# Giving executable permission to crontab file
RUN chmod 0644 /etc/cron.d/my-cron-file

# Running crontab
RUN crontab /etc/cron.d/my-cron-file

# Creating entry point for cron 
ENTRYPOINT ["cron", "-f"]
