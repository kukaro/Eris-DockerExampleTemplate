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
set cindent         " C언어 자동 들여쓰기
set showmatch       " 매치되는 괄호의 반대쪽을 보여줌
set autoindent      " 자동 인덴트 세팅
set cindent         " 자동 인덴트 세팅
set shiftwidth=4    " 자동 인덴트할 때 너비

set rtp+=~/.vim/bundle/Vundle.vim
call vundle#begin()
Plugin 'VundleVim/Vundle.vim'
Plugin 'fatih/vim-go'
Plugin 'scrooloose/nerdtree'
Plugin 'vim-airline/vim-airline'
Plugin 'vim-gitgutter'
Plugin 'townk/vim-autoclose'
Plugin 'maksimr/vim-jsbeautify'
Plugin 'leafOfTree/vim-vue-plugin'
call vundle#end()

filetype plugin on

nmap nerd :NERDTreeToggle<CR>
" https://vim.fandom.com/wiki/Get_the_name_of_the_current_fil
" 위 사이트 참조했음

".vimrc
map cf :call JsBeautify()<cr>
" or
autocmd FileType javascript noremap <buffer>  <c-f> :call JsBeautify()<cr>
" for json
autocmd FileType json noremap <buffer> <c-f> :call JsonBeautify()<cr>
" for jsx
autocmd FileType jsx noremap <buffer> <c-f> :call JsxBeautify()<cr>
" for html
autocmd FileType html noremap <buffer> <c-f> :call HtmlBeautify()<cr>
" for css or scss
autocmd FileType css noremap <buffer> <c-f> :call CSSBeautify()<cr>
