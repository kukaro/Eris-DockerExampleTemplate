#!/usr/bin/env bash
vim -c 'PluginInstall' -c 'qa!'
cd /root/.vim/bundle/vim-prettier && npm install