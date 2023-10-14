FROM php:8.2.10-cli-bullseye

RUN \
    apt update \
    && apt install -y git diffstat \
    && git config --global --add safe.directory /app
