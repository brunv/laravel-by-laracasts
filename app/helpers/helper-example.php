<?php

// Não esquecer de adicionar em "autoload" em composer.json
// e recompilar 'composer dump-autoload'

function flash($message)
{
    session()->flash('feedback', $message);
}