#!/usr/bin/env bash
echo 'run vim.sh' >> log.txt
vim -c 'PluginInstall' -c 'qa!'
cd /root/.vim/bundle/vim-prettier && npm install