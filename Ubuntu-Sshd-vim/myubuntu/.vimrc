if has("syntax")
	syntax on
endif

set autoindent
set cindent

set nu

set ts=4
set shiftwidth=4

set laststatus=2
set statusline=\ %<%l:%v\ [%P]%=%a\ %h%m%r\ %F\

set autoread
set paste

set rtp+=~/.vim/bundle/Vundle.vim
call vundle#begin()
Plugin 'VundleVim/Vundle.vim'
Plugin 'fatih/vim-go'
Plugin 'scrooloose/nerdtree'
Plugin 'vim-airline/vim-airline'
Plugin 'vim-gitgutter'
Plugin 'maksimr/vim-jsbeautify'
call vundle#end()

filetype plugin on

nmap nerd :NERDTreeToggle<CR>

autocmd FileType javascript vnoremap <buffer>  <F9> :call RangeJsBeautify()<cr>
autocmd FileType json vnoremap <buffer> <F9> :call RangeJsonBeautify()<cr>
autocmd FileType jsx vnoremap <buffer> <F9> :call RangeJsxBeautify()<cr>
autocmd FileType html vnoremap <buffer> <F9> :call RangeHtmlBeautify()<cr>
autocmd FileType css vnoremap <buffer> <F9> :call RangeCSSBeautify()<cr>
