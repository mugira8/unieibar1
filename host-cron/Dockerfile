# Pulling Alpine image
FROM alpine:latest

# Setting up work directory
WORKDIR /cron

# Updating the packages
# RUN apk update && \
# apk upgrade --available && sync && \

# Copy script file into container.
COPY send_email.ipynb .
COPY send_email.sh .

# Giving executable permission to script file.
RUN chmod +x send_email.sh
