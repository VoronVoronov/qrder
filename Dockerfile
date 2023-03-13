FROM ubuntu:latest

RUN apt-get update \
    && apt-get install -y software-properties-common \
    && add-apt-repository -y ppa:certbot/certbot \
    && apt-get update \
    && apt-get install -y certbot
