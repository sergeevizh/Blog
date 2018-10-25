<?php
/**
 * Класс Highlight, для подсветки кода в публикациях
 */
class Highlight {

    private $settings = array(
        'apache' => array(
            'colors' => array(
                'default'  => array('fore' => '#0080FF'),
                'comment'  => array('fore' => '#888888'),
                'vars'     => array('fore' => '#808000'),
                'string'   => array('fore' => '#0000FF'),
                'section'  => array('fore' => '#8000FF'),
                'param'    => array('fore' => '#008080'),
                'flags'    => array('fore' => '#CC6600'),
                'regexp1'  => array('fore' => '#CC0099'),
                'regexp2'  => array('fore' => '#CC0099'),
            )
        ),
        'awk' => array(
            'colors' => array(
                'default'     => array('fore' => '#008080'),
                'comment'     => array('fore' => '#888888'),
                'string'      => array('fore' => '#0080FF'),
                'spec-var'    => array('fore' => '#808000'),
                '$variable'   => array('fore' => '#808000'),
                '$expression' => array('fore' => '#808000'),
                'keyword'     => array('fore' => '#8000FF'),
                'begin-end'   => array('fore' => '#800080'),
                'pattern'     => array('fore' => '#800080'),
                'digit'       => array('fore' => '#FF00FF'),
                'delimiter'   => array('fore' => '#FF0000'),
                'number'      => array('fore' => '#CCCCCC'),
            ),
            'keyword' => array(
                'if', 'else', 'for', 'in', 'while', 'do', 'break', 'continue', 'next', 'exit', 'return', 'printf', 'print', 'delete', 'function'
            ),
            'begin-end' => array(
                'BEGIN', 'END'
            ),
            'delimiter' => array(
                ',', ';', '=', '{', '}', '(', ')', '*', '+', '/', '-', '>', '<'
            ),
        ),
        'bash' => array(
            'colors' => array(
                'default'     => array('fore' => '#008080'),
                'bin-bash'    => array('fore' => '#888888', 'back' => '#FFFFFF'),
                'here-doc'    => array('fore' => '#BB00BB'),
                'comment1'    => array('fore' => '#888888'),
                'comment2'    => array('fore' => '#888888'),
                'comment3'    => array('fore' => '#888888'),
                'string1'     => array('fore' => '#0000DD'),
                'string2'     => array('fore' => '#0080FF'),
                'variable1'   => array('fore' => '#808000'),
                'variable2'   => array('fore' => '#808000'),
                'spec-var'    => array('fore' => '#808000'),
                'express'     => array('back' => '#FFF0F0'),
                'execute1'    => array('back' => '#FFFFEB'),
                'execute2'    => array('back' => '#FFFFFF'),
                'execute3'    => array('back' => '#FFFFFF'),
                'arr-init'    => array('back' => '#F5FFF5'),
                'function'    => array('fore' => '#AA00AA'),
                'keyword'     => array('fore' => '#8000FF'),
                'command'     => array('fore' => '#CC6600'),
                'signal'      => array('fore' => '#FF0000'),
                'number'      => array('fore' => '#CCCCCC'),
            ),
            'keyword' => array(
                'if', 'then', 'else', 'elif', 'fi', 'for', 'while', 'until', 'break', 'continue', 'in', 'do', 'done', 'case', 'esac', 'function', 'return', 'local', 'declare'
            ),
            'command' => array(
                'exit', 'exec', 'export', 'read', 'shift', 'sleep', 'wait', 'source', 'true', 'false', 'echo', 'set'
            ),
            'signal' => array(
                'SIGHUP', 'SIGINT', 'SIGQUIT', 'SIGKILL', 'SIGTERM', 'SIGCONT', 'SIGSTOP', 'SIGTSTP'
            ),
            'delimiter' => array(
                ';', '&&', '\|\|', '\[', '\]', '\(\(', '\)\)'
            ),
        ),
        'code' => array(
            'colors' => array(
                'default'   => array('fore'   => '#0080FF'),
                'selected1' => array('fore'   => '#EE0000'),
                'selected2' => array('fore'   => '#008080'),
                'selected3' => array('border' => '#FF0000'),
            ),
            'specchars' => array('&', '>', '<'),
        ),
        'cli' => array(
            'colors' => array(
                'default'   => array('fore' => '#0080FF'),
                'cliprompt' => array('fore' => '#AAAAAA'),
                'command'   => array('fore' => '#8000FF'),
                'comment'   => array('fore' => '#888888'),
                'selected1' => array('fore' => '#EE0000'),
                'selected2' => array('fore' => '#008080'),
            ),
            'specchars' => array('&', '>', '<'),
        ),
        'css' => array(
            'colors' => array(
                'default'     => array('fore' => '#008080'),
                'comment'     => array('fore' => '#888888'),
                'string'      => array('fore' => '#0000FF'),
                'import'      => array('fore' => '#EE00EE'),
                'media'       => array('fore' => '#EE00EE'),
                'prop-name'   => array('fore' => '#0080C0'),
                'prop-value'  => array('fore' => '#0080FF'),
                'css-uniq'    => array('fore' => '#8000FF'),
                'css-class'   => array('fore' => '#808000'),
                'pseudo-el'   => array('fore' => '#CC6600'),
                'pseudo-cl'   => array('fore' => '#CC6600'),
                'pseudo-cl-n' => array('fore' => '#CC6600'),
                'delimiter'   => array('fore' => '#FF0000'),
                'number'      => array('fore' => '#CCCCCC'),
            ),
            'function' => array('url', 'attr', 'calc', 'rgb'),
            'delimiter' => array('+', '~', ',', '>', ':', ';', '[', ']', '(', ')', '{', '}', '='),
        ),
        'erp' => array(
            'colors' => array(
                'default'   => array('fore' => '#008080'),
                'comment'   => array('fore' => '#888888'),
                'string'    => array('fore' => '#0000FF'),
                'keyword1'  => array('fore' => '#8B008B'),
                'keyword2'  => array('fore' => '#8000FF'),
                'keyword3'  => array('fore' => '#BB00BB'),
                'directive' => array('fore' => '#808000'),
                'code-area' => array('fore' => '#808000'),
                'area-name' => array('fore' => '#0080FF'),
                'datetime'  => array('fore' => '#DD00DD'),
                // 'object'    => array('fore' => '#0080FF'),
                // 'function'  => array('fore' => '#0080FF'),
                // 'procedure' => array('fore' => '#0080FF'),
                'def-call'  => array('fore' => '#0080C0'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'Процедура', 'КонецПроцедуры', 'Функция', 'КонецФункции', 'Экспорт'
            ),
            'keyword2' => array(
                'Пока', 'Для', 'Каждого', 'По', 'Из', 'Цикл', 'КонецЦикла', 'Прервать', 'Продолжить', 'Если', 'Тогда', 'Иначе', 'ИначеЕсли', 'КонецЕсли', 'Попытка', 'Исключение', 'КонецПопытки', 'Новый', 'Возврат', 'Знач', 'Перем'
            ),
            'keyword3' => array(
                'Истина', 'Ложь', 'НЕ', 'И', 'ИЛИ', 'Неопределено'
            ),
            'directive' => array(
                '&НаКлиентеНаСервереБезКонтекста', '&НаСервереБезКонтекста', '&НаСервереНаКлиенте', '&НаКлиенте', '&НаСервере'
            ),
            'delimiter' => array(
                '=', ';', '.', '(', ')', '[', ']', ',', '+', '*', '-', '/', '!', '>', '<', '%', '?'
            ),
        ),
        'js' => array(
            'colors' => array(
                'default'   => array('fore' => '#008080'),
                'comment1'  => array('fore' => '#888888'),
                'comment2'  => array('fore' => '#888888'),
                'string1'   => array('fore' => '#0000FF'),
                'string2'   => array('fore' => '#0000FF'),
                'regexp'    => array('fore' => '#EE8000'),
                'keyword1'  => array('fore' => '#8000FF'),
                'keyword2'  => array('fore' => '#808000'),
                //'def-call'  => array('fore' => '#808040'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'if', 'else', 'elseif', 'for', 'while', 'foreach', 'as', 'break', 'continue', 'return', 'switch', 'case', 'default', 'do', 'with', 'in', 'abstract', 'class', 'extends', 'function', 'final', 'public', 'protected', 'private', 'static', 'self', 'new', 'instanceof', 'interface', 'this', 'try', 'throw', 'throws', 'finally', 'implements', 'super', 'var',  'typeof', 'void'
            ),
            'keyword2' => array(
                'true', 'false', 'boolean', 'int', 'float', 'undefined', 'null'
            ),
            'delimiter' => array(
                '.', ',', ':', ';', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}', '>', '<', '|', '!', '?', '&'
            ),
        ),
        'json' => array(
            'colors' => array(
                'default'   => array('fore' => '#000000'),
                'string'    => array('fore' => '#0080FF'),
                'null'      => array('fore' => '#808000'),
                'bool'      => array('fore' => '#FF8000'),
                'digit'     => array('fore' => '#EE00EE'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'delimiter' => array(
                ',', ':', '[', ']', '{', '}'
            ),
        ),
        'html' => array(
            'colors' => array(
                'default'   => array('fore' => '#333333'),
                'doctype'   => array('fore' => '#0080C0', 'back' => '#FFFFFF'),
                'comment'   => array('fore' => '#888888'),
                'string'    => array('fore' => '#0080FF'),
                'element'   => array('fore' => '#0080C0'),
                'entity'    => array('fore' => '#8000FF'),
                'attrname'  => array('fore' => '#808000'),
                'attrval1'  => array('fore' => '#0080FF'),
                'attrval2'  => array('fore' => '#0080FF'),
                'equal'     => array('fore' => '#EE0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
        ),
        'idle' => array(
            'colors' => array(
                'default'    => array('fore' => '#0080FF'),
                'idleprompt' => array('fore' => '#AAAAAA'),
                'command'    => array('fore' => '#8000FF'),
                'comment'    => array('fore' => '#888888'),
            ),
            'specchars' => array('&', '>', '<'),
        ),
        'ini' => array(
            'colors' => array(
                'default'  => array('fore' => '#0080FF'),
                'comment'  => array('fore' => '#888888'),
                'section'  => array('fore' => '#8000FF'),
                'param'    => array('fore' => '#008080'),
                'string'   => array('fore' => '#0000FF'),
                'equal'    => array('fore' => '#FF0000')
            )
        ),
        'mysql' => array(
            'colors' => array(
                'default'  => array('fore' => '#8000FF'),
                'comment1' => array('fore' => '#888888'),
                'comment2' => array('fore' => '#888888'),
                'comment3' => array('fore' => '#888888'),
                'string1'  => array('fore' => '#0080FF'),
                'string2'  => array('fore' => '#0080FF'),
                'string3'  => array('fore' => '#0080C0'),
                'type'     => array('fore' => '#808000'),
                'digit'    => array('fore' => '#DD00DD'),
                'delimiter'=> array('fore' => '#FF0000'),
            ),
            'type' => array(
                'TINYINT', 'SMALLINT', 'MEDIUMINT', 'INTEGER', 'BIGINT', 'INT', 'FLOAT', 'DOUBLE', 'REAL', 'DECIMAL', 'NUMERIC', 'BIT', 'YEAR', 'DATETIME', 'DATE', 'TIMESTAMP', 'TIME', 'VARCHAR', 'CHAR', 'VARBINARY', 'BINARY', 'TINYBLOB', 'MEDIUMBLOB', 'LONGBLOB', 'BLOB', 'TINYTEXT', 'MEDIUMTEXT', 'LONGTEXT', 'TEXT', 'ENUM', 'SET'
            ),
            'delimiter' => array(
                '.', ',', ';', '=', '(', ')', '@', '*'
            ),
        ),
        'php' => array(
            'colors' => array(
                'default'   => array('fore' => '#008080'),
                'startphp'  => array('fore' => '#FF0000', 'back' => '#FFFFEE'),
                'shortphp'  => array('fore' => '#FF0000', 'back' => '#FFFFEE'),
                'startecho' => array('fore' => '#FF0000', 'back' => '#FFFFEE'),
                'startecho' => array('fore' => '#FF0000', 'back' => '#FFFFEE'),
                'stopphp'   => array('fore' => '#FF0000', 'back' => '#FFFFEE'),
                'comment1'  => array('fore' => '#888888'),
                'comment2'  => array('fore' => '#888888'),
                'string1'   => array('fore' => '#0000EE'),
                'string2'   => array('fore' => '#0000FF'),
                'keyword1'  => array('fore' => '#8000FF'),
                'keyword2'  => array('fore' => '#808000'),
                'keyword3'  => array('fore' => '#CC6600'),
                'function'  => array('fore' => '#0080FF'),
                'def-call'  => array('fore' => '#0080C0'),
                'defined'   => array('fore' => '#EE00EE'),
                'constant'  => array('fore' => '#AA00AA'),
                'super-arr' => array('fore' => '#00AA00'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'if', 'else', 'elseif', 'endif', 'for', 'endfor', 'while', 'endwhile', 'foreach', 'endforeach', 'as', 'break', 'continue', 'try', 'catch', 'finally', 'throw', 'return', 'switch', 'case', 'default', 'namespace', 'use', 'abstract', 'class', 'extends', 'function', 'public', 'protected', 'private', 'static', 'self', 'new', 'parent', 'const', 'array', 'int', 'float', 'bool', 'mixed',  'string', 'object', 'list', 'global'
            ),
            'keyword2' => array(
                'echo', 'exit', 'die', 'require_once', 'require', 'include_once', 'include'
            ),
            'keyword3' => array(
                'true', 'false', 'null'
            ),
            'function' => array(
                'echo', 'exit', 'die', 'require_once', 'require', 'include_once', 'include', 'isset', 'unset', 'implode', 'explode', 'get_class', 'lcfirst', 'ucfirst', 'iconv', 'empty', 'is_null', 'count', 'print_r', 'var_dump', 'header', 'readfile', 'filesize', 'date', 'time', 'fopen', 'fsockopen', 'feof', 'fread', 'fwrite', 'fclose', 'urlencode', 'urldecode', 'file_get_contents', 'file_put_contents', 'md5', 'uniqid', 'move_uploaded_file', 'strlen', 'substr', 'str_replace', 'str_split', 'str_repeat', 'iconv_strlen', 'iconv_substr', 'iconv_strpos', 'realpath', 'ctype_digit', 'file_exists', 'define', 'is_file', 'is_dir', 'basename', 'fseek', 'filemtime', 'fpassthru', 'defined', 'is_object', 'is_array', 'json_encode', 'json_decode', 'array_merge', 'array_keys', 'in_array', 'array_key_exists', 'array_search', 'stream_context_create', 'ob_start', 'ob_get_clean', 'preg_replace', 'preg_match', 'preg_match_all', 'strtolower', 'strtoupper', 'trim', 'rtrim', 'ltrim', 'nl2br', 'htmlspecialchars', 'ini_get', 'ini_set', 'session_start', 'session_get_cookie_params', 'session_set_cookie_params', 'setcookie', 'pathinfo', 'base64_encode', 'base64_decode', 'sprintf', 'ord', 'chr', 'fgets', 'bindec', 'sleep', 'usleep', 'socket_create', 'socket_bind', 'socket_set_option', 'socket_listen', 'socket_select', 'socket_accept', 'socket_read', 'socket_write', 'socket_shutdown', 'socket_close', 'socket_getpeername', 'socket_last_error', 'socket_strerror', 'is_callable', 'call_user_func', 'error_reporting', 'set_time_limit', 'ob_implicit_flush', 'pack', 'sha1', 'stream_socket_server', 'stream_select', 'stream_socket_accept', 'stream_socket_get_name', 'is_resource', 'is_string', 'parse_url', 'dirname'
            ),
            'defined' => array(
                '__LINE__', '__FILE__', '__DIR__', '__FUNCTION__', '__CLASS__', '__METHOD__', '__TRAIT__', 'DIRECTORY_SEPARATOR', 'PHP_EOL', 'E_ALL'
            ),
            'delimiter' => array(
                '.', ',', ':', ';', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}', '>', '<', '|', '!', '?', '&', '@', '\\', '^', '~'
            ),
        ),
        'phtml' => array(
            'colors' => array(
                'default'   => array('fore' => '#888888'),
            )
        ),
        'python' => array(
            'colors' => array(
                'default'   => array('fore' => '#008080'),
                'comment'   => array('fore' => '#888888'),
                'string1'   => array('fore' => '#0000FF'),
                'string2'   => array('fore' => '#0000FF'),
                'string3'   => array('fore' => '#0080FF'),
                'string4'   => array('fore' => '#0080FF'),
                'keyword1'  => array('fore' => '#8000FF'),
                'keyword2'  => array('fore' => '#DD00DD'),
                'function'  => array('fore' => '#0080FF'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'def', 'if', 'else', 'elif', 'for', 'in', 'while', 'break', 'continue', 'del', 'try', 'except', 'raise', 'finally', 'from', 'import', 'return', 'pass', 'lambda', 'with', 'as', 'not', 'and', 'or', 'is'
            ),
            'keyword2' => array(
                'True', 'False', 'None'
            ),
            'function' => array(
                'object', 'dict', 'list', 'tuple', 'set', 'bool', 'float', 'int', 'str', 'slice', 'range', 'len', 'input', 'print', 'min', 'max', 'sum', 'round', 'type', 'open'
            ),
            'delimiter' => array(
                '.', ',', ':', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}', '>', '<', '|', '!'
            ),
        ),
        'query' => array(
            'colors' => array(
                'default'   => array('fore' => '#0080C0'),
                'comment'   => array('fore' => '#888888'),
                'string'    => array('fore' => '#0000FF'),
                'property'  => array('fore' => '#0080FF'),
                'keyword1'  => array('fore' => '#8000FF'),
                'keyword2'  => array('fore' => '#CC00CC'),
                'function'  => array('fore' => '#808000'),
                'parameter' => array('fore' => '#CC6600'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'ВЫБРАТЬ', 'ПЕРВЫЕ', 'РАЗЛИЧНЫЕ', 'РАЗРЕШЕННЫЕ', 'ПОМЕСТИТЬ', 'ИЗ', 'СОЕДИНЕНИЕ', 'ЛЕВОЕ', 'ПРАВОЕ', 'ПО', 'ГДЕ', 'В', 'ИЕРАРХИИ', 'МЕЖДУ', 'ПОДОБНО', 'ЕСТЬ', 'СГРУППИРОВАТЬ', 'ПО', 'УПОРЯДОЧИТЬ', 'ИМЕЮЩИЕ', 'ИТОГИ', 'КАК', 'ВЫБОР', 'КОГДА', 'ИНАЧЕ', 'КОНЕЦ', 'ТОЛЬКО', 'ИЕРАРХИЯ', 'ИЕРАРХИИ', 'ССЫЛКА', 'ОБЪЕДИНИТЬ', 'ВСЕ', 'И', 'ИЛИ', 'НЕ'
            ),
            'keyword2' => array(
                'ИСТИНА', 'ЛОЖЬ', 'NULL'
            ),
            'function'=> array(
                'СУММА', 'КОЛИЧЕСТВО', 'ЕСТЬNULL', 'ПРЕДСТАВЛЕНИЕ', 'ПРЕДСТАВЛЕНИЕССЫЛКИ', 'ВЫРАЗИТЬ', 'ЗНАЧЕНИЕ', 'РАЗНОСТЬДАТ', 'ДОБАВИТЬКДАТЕ', 'НАЧАЛОПЕРИОДА', 'КОНЕЦПЕРИОДА', 'ТИП', 'ТИПЗНАЧЕНИЯ', 'ВЫРАЗИТЬ'
            ),
            'delimiter' => array(
                '.', ',', '=', '(', ')', '{', '}', '>', '<', '!', '*'
            ),
        ),
        'xml' => array(
            'colors' => array(
                'default'   => array('fore' => '#222222'),
                'xmldecl'   => array('fore' => '#8B008B'),
                'comment'   => array('fore' => '#888888'),
                'element'   => array('fore' => '#0080C0'),
                'attrname'  => array('fore' => '#808000'),
                'attrvalue' => array('fore' => '#0080FF'),
                'entity'    => array('fore' => '#8000FF'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
        )

    );


    public function highlightApache($code) {

        $code = $this->trim($code);

        $pattern = array(
            'comment' => '~^\s*#.*~m',                                   // комментарии
            'vars'    => '~(%|\$)\{[^\}]+\}~',                           // переменные
            'string'  => '~"[^"]*"~',                                    // строки в двойных кавычках
            'section' => '~\<[^>]+\>~',                                  // секция
            'regexp1' => '~(?<=RewriteRule )\S+(?= )~',                  // шаблон рег.выражения в RewriteRule (mod_rewrite)
            'empty'   => '~(?<=RewriteCond )[^\s¤]+(?= )~',              // хак, чтобы след.строка правильно отработала
            'regexp2' => '~(?<=RewriteCond ¤[a-f0-9]{32}¤ )\S+(?=\s)~',  // шаблон рег.выражения в RewriteCond (mod_rewrite)
            'param'   => '~^\s*[a-z]+(?= )~im',                          // параметр
            'flags'   => '~(?<= )\[[^\]]+\](?= |$)~m',                   // флаги (mod_rewrite)
        );

        $code = $this->highlightCodeString($code, $pattern, 'apache');

        return '<pre style="color:'.$this->settings['apache']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightAWK($code) {

        $code = $this->trim($code);

        foreach ($this->settings['awk']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }

        $pattern = array(
            'comment'     => '~# .*~',                    // комментарии
            'spec-var'    => '~\$[0-9]~',                 // позиционные переменные
            '$variable'   => '~\$[_a-z][_a-z0-9]*~',      // позиционные переменные
            '$expression' => '~\$\([^)]+\)~',             // позиционные переменные
            'string'      => '~"[^"]*"~',                 // строки в двойных кавычках
            'keyword'     => '~\b('.implode('|', $this->settings['awk']['keyword']).')\b~',   // ключевые слова
            'begin-end'   => '~\b('.implode('|', $this->settings['awk']['begin-end']).')\b~', // BEGIN и END
            'pattern'     => '~/[^/]+/~', // регулярное выражение
            'digit'       => '~\b\d+\b~', // цифры
            'delimiter'   => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'awk');

        return '<pre style="color:'.$this->settings['awk']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightBash($code) {

        $code = $this->trim($code);

        $temp1 = array(
            'comment1'    => '~^ *#+$~m',                          // пустой комментарий
            'comment2'    => '~^ *#+ .*$~m',                       // комментарии от начала строки
            'comment3'    => '~(?<= )#+ .*~',                      // комментарии в конце строки
            'string1'     => "~'[^']*'~",                          // строки в одинарных кавычках
        );
        if (preg_match_all('~^[_a-z][_a-z0-9]*(?=\(\) \{)~im', $code, $matches)) {
            foreach($matches[0] as $match)
            $functions[] = $match;
        }
        if (preg_match_all('~(?<=function )[_a-z][_a-z0-9]*(?= \{)~i', $code, $matches)) {
            foreach($matches[0] as $match)
            $functions[] = $match;
        }
        $temp = array();
        if (!empty($functions)) {
            $temp['function'] = '~\b('.implode('|', $functions).')\b~';
        }
        $temp2 = array(
            'spec-var'    => '~\$([0-9]|#|!|\*|@|\$|\?)~i',        // специальные переменные
            'variable1'   => '~\$[a-z_][a-z0-9_]*~i',              // переменные
            'variable2'   => '~\$\{[^}]+\}?~i',                    // переменные
            'express'     => '~\$?\(\([^)(]+\)\)~',                // вычисление арифметического выражения
            'execute1'    => '~\$\([^)(]+\)~',                     // подстановка результата выполнения
            'execute2'    => '~\$\([^)(]+\)~',                     // подстановка результата выполнения
            'execute3'    => '~\`[^`]+`~',                         // подстановка результата выполнения
            'string2'     => '~"[^"]*"~',                          // строки в двойных кавычках
            'here-doc'    => '~(?<=\<\<) ?-?([-_A-Za-z]+).*?\1~s', // here doc
            'arr-init'    => '~(?<=[a-z]\=)\([^)]*\)~i',           // инициализация массива
            'keyword'     => '~\b('.implode('|', $this->settings['bash']['keyword']).')\b~i', // ключевые слова
            'command'     => '~\b('.implode('|', $this->settings['bash']['command']).')\b~i', // команды
            'signal'      => '~\b('.implode('|', $this->settings['bash']['signal']).')\b~',   // сигналы
            'bin-bash'    => "~^#!/[-/a-z]+~",                      // что-то типа #!/bin/bash
        );

        $pattern = array_merge($temp1, $temp, $temp2);

        $code = $this->highlightCodeString($code, $pattern, 'bash');

        return '<pre style="color:'.$this->settings['bash']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightCLI($code) {

        $code = $this->trim($code);

        foreach ($this->settings['cli']['specchars'] as $value) {
            $specchars[] = '\\'.$value;
        }

        $pattern = array(
            'selected1' => '~\[red\].*\[/red\]~sU',         // выделить текст
            'selected2' => '~\[grn\].*\[/grn\]~sU',         // выделить текст
            'comment'   => '~(?<= )# .*$~m',                // комментарий
            'command'   => '~(?<=^(\$|\>) ).*$~m',          // команда
            'cliprompt' => '~^(\$|\>)(?= |$)~m',            // приглашение
            'specchars' => '~'.implode('|', $specchars).'~' // спец.символы
        );

        $code = $this->highlightCodeString($code, $pattern, 'cli');

        $code = str_replace(array('[red]', '[grn]', '[/red]', '[/grn]'), '', $code);

        return '<pre style="color:'.$this->settings['cli']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightCode($code) {

        $code = $this->trim($code);

        foreach ($this->settings['code']['specchars'] as $value) {
            $specchars[] = '\\'.$value;
        }

        $pattern = array(
            'selected1' => '~\[red\].*\[/red\]~sU',         // выделить текст
            'selected2' => '~\[grn\].*\[/grn\]~sU',         // выделить текст
            'selected3' => '~\[border\].*\[/border\]~sU',   // выделить текст
            'specchars' => '~'.implode('|', $specchars).'~' // спец.символы
        );

        $code = $this->highlightCodeString($code, $pattern, 'code');

        $code = str_replace(array('[red]', '[grn]', '[border]', '[/red]', '[/grn]', '[/border]'), '', $code);

        return '<pre style="color:'.$this->settings['code']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightCSS($code, $pre = true) {

        if ($pre) {
            $code = $this->trim($code);
        }

        foreach ($this->settings['css']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'comment'     => '~/\*.*\*/~sU',                     // комментарии
            'prop-name'   => '~^\s*[-a-z]+\s*(?=:)~m',           // свойство
            'prop-value'  => '~(?<=¤:)\s*[^;¤{]+\s*(?=;)~',      // значение свойства
            'string'      => '~"[^"]*"|\'[^\']*\'~',             // строка
            'import'      => '~@import~',                        // @import
            'media'       => '~@media~',                         // @media
            'css-uniq'    => '~#[-_a-z]+~',                      // селектор, идентификатор
            'css-class'   => '~\.[-_a-z]+~',                     // селектор, класс
            'pseudo-el'   => '~::[-a-z]+~',                      // псевдо-элементы ::first-letter или ::before
            'pseudo-cl-n' => '~:[-a-z]+\([^)]*\)~',              // псевдо-классы :not(:first-child) или :nth-child(even)
            'pseudo-cl'   => '~:[-a-z]+~',                       // псевдо-классы :first-letter или :first-line
            'delimiter'   => '~'.implode('|', $delimiter).'~',   // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'css');
        
        if (!$pre) {
            return $code;
        }

        return '<pre style="color:'.$this->settings['css']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightERP($code) {

        $code = $this->trim($code);
        $code = $this->collapse($code);

        foreach ($this->settings['erp']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'comment'   => '~\/\/.*$~m', // комментарии
            'string'    => '~"[^"]*"~',   // строки
            // 'object'    => '~(?<=Новый )[а-яa-z]+\b~ui', // создание объекта
            // 'function'  => '~(?<=Функция )[а-яa-z]+\b~ui', // объявление функции
            // 'procedure' => '~(?<=Процедура )[а-яa-z]+\b~ui', // объявление процедуры
            'keyword1'  => '~\b('.implode('|', $this->settings['erp']['keyword1']).')\b~ui',  // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings['erp']['keyword2']).')\b~ui',  // ключевые слова
            'keyword3'  => '~\b('.implode('|', $this->settings['erp']['keyword3']).')\b~ui',  // ключевые слова
            'def-call'  => '~\b[а-яa-z]+\b\s?(?=\()~ui', // определение или вызов функции или процедуры
            'directive' => '~('.implode('|', $this->settings['erp']['directive']).')~ui', // директивы компиляции
            'area-name' => '~(?<=#Область )[а-яa-z]+~ui', // имя области кода
            'code-area' => '~#(Область|КонецОбласти)~ui', // области кода
            'datetime'  => "~'\d+'~", // дата и время
            'digit'     => '~\b\d+\b~u', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'erp');

        $code = str_replace(
            array(chr(5), chr(6)),
            array(
                '<div class="collapse"><i class="fa fa-minus-square-o" aria-hidden="true"></i><div class="collapse-code">',
                '</div><div class="collapse-message">[код свернут]</div></div>'
            ), $code
        );

        return '<pre style="color:'.$this->settings['erp']['colors']['default']['fore'].'" class="erp">' . $code . '</pre>';

    }
    
    public function highlightHTMLOld($code) {

        $code = $this->trim($code);

        $pattern = array(
            'doctype'   => '~<\!DOCTYPE[^>]*>~i',          // <!DOCTYPE html>
            'comment'   => '~<\!--.*-->~sU',               // комментарии
            'entity'    => '~&[a-z]+;~',                   // html-сущности
            'attrname'  => '~(?<= )[-a-z0-9:]+(?=\=")~',   // имя атрибут тега
            'attrvalue' => '~(?<=\=)"[^"]*"(?=(\s|/|>))~', // значение атрибут тега
            //'equal'     => '~(?<=¤)\=(?=¤)~',            // разделитель между атрибутом и значением
            'element'   => '~</?[a-z0-9]+[^>]*>~',         // открывающие и закрывающие теги
        );

        $code = $this->highlightCodeString($code, $pattern, 'html');

        return '<pre style="color:'.$this->settings['html']['colors']['default']['fore'].'">' . $code . '</pre>';
    }

    public function highlightHTML($code) {
        
        $code = $this->trim($code);

        /*
         * 1. вырезаем куски javascript-кода, вставляя на это место заглушки, и раскрашиваем все эти куски
         * 2. потом раскрашиваем оставшийся html-код, действуя как обычно
         * 3. вставляем на место заглушек из первого шага раскрашенные кусочки javascript-кода
         */
        $offset = 0;
        $source_js = array();
        $replace_js = array();
        while (preg_match('~<script(?: type="(?:text|application)/javascript")?>(.+)</script>~Us', $code, $match, PREG_OFFSET_CAPTURE, $offset)) {
            $item = $match[1][0];
            $offset = $match[1][1];
            $length = strlen($match[1][0]);

            $piece = $this->highlightJS($item, false);
            $source_js[] = '<span style="color:'.$this->settings['js']['colors']['default']['fore'].'">' . $piece . '</span>';
            $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
            $replace_js[] = $rand;
            $code = substr_replace($code, $rand, $offset, $length);
            $offset = $offset + strlen($rand) + 9; // 9 = strlen(</script>)
        }
        
        /*
         * 1. вырезаем куски css-кода, вставляя на это место заглушки, и раскрашиваем все эти куски
         * 2. потом раскрашиваем оставшийся html-код, действуя как обычно
         * 3. вставляем на место заглушек из первого шага раскрашенные кусочки css-кода
         */
        $offset = 0;
        $source_css = array();
        $replace_css = array();
        while (preg_match('~<style(?: type="text/css")?>(.+)</style>~Us', $code, $match, PREG_OFFSET_CAPTURE, $offset)) {
            $item = $match[1][0];
            $offset = $match[1][1];
            $length = strlen($match[1][0]);

            $piece = $this->highlightCSS($item, false);
            $source_css[] = '<span style="color:'.$this->settings['css']['colors']['default']['fore'].'">' . $piece . '</span>';
            $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
            $replace_css[] = $rand;
            $code = substr_replace($code, $rand, $offset, $length);
            $offset = $offset + strlen($rand) + 8; // 8 = strlen(</style>)
        }

        // атрибуты тега раскрашиваем отдельно, для этого вырезаем их, вставляем на это место заглушки
        $offset = 0;
        $source = array();
        $replace = array();
        while (preg_match('~<[a-z0-9]+ ([^>]+)>~', $code, $match, PREG_OFFSET_CAPTURE, $offset)) {
            $item = $match[1][0];
            $offset = $match[1][1];
            $len = strlen($match[1][0]);
            
            $source[] = $this->highlightAttribute($item);
            $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
            $replace[] = $rand;
            $code = substr_replace($code, $rand, $offset, $len);
            $offset = $offset + strlen($rand) + 1;
        }

        /*
         * теперь раскрашиваем html
         */
        $pattern = array(
            'doctype'   => '~<\!DOCTYPE[^>]*>~i',                  // <!DOCTYPE html>
            'comment'   => '~<\!--.*-->~sU',                       // комментарии
            'entity'    => '~&[a-z]+;~',                           // html-сущности
            'element'   => '~</?[a-z0-9]+[^>]*>~',                 // открывающие и закрывающие теги
        );

        $code = $this->highlightCodeString($code, $pattern, 'html');
        
        $source = array_reverse($source);
        $replace = array_reverse($replace);
        if (!empty($source)) {
            $code = str_replace($replace, $source, $code);
        }

        /*
         * вставляем куски javascript-кода обратно
         */
        $source_js = array_reverse($source_js);
        $replace_js = array_reverse($replace_js);
        if (!empty($source_js)) {
            $code = str_replace($replace_js, $source_js, $code);
        }
        
        /*
         * вставляем куски css-кода обратно
         */
        $source_css = array_reverse($source_css);
        $replace_css = array_reverse($replace_css);
        if (!empty($source_css)) {
            $code = str_replace($replace_css, $source_css, $code);
        }
        
        return '<pre style="color:'.$this->settings['html']['colors']['default']['fore'].'">' . $code . '</pre>';

    }
    
    private function highlightAttribute($code) {
        $code = ' '.$code;
        $pattern = array(
            'attrval1' => '~"[^"]*"~',                       // значение атрибута тега
            'attrval2' => "~'[^']*'~",                       // значение атрибута тега
            'attrname' => '~(?<= )[-a-z0-9:]+(?=(\=|\s))~',  // имя атрибута тега
        );
        return substr($this->highlightCodeString($code, $pattern, 'html'), 1);
    }

    public function highlightJS($code, $pre = true) {

        if ($pre) {
            $code = $this->trim($code);
        }

        foreach ($this->settings['js']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'comment1'  => '~\/\/ .*$~m',     // комментарии
            'comment2'  => '~/\*.*\*/~sU',    // комментарии
            'string1'   => '~"[^"]*"~',       // строки в двойных кавычках
            'string2'   => "~'[^']*'~",       // строки в одинарных кавычках
            'regexp'    => "~/[^/]+/[igm]*~", // регулярное выражение
            'keyword1'  => '~\b('.implode('|', $this->settings['js']['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings['js']['keyword2']).')\b~i', // ключевые слова
            //'def-call'  => '~\b[_a-z][_a-z0-9]*\b\s?(?=\()~i', // определение или вызов функции
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'js');
        
        if (!$pre) {
            return $code;
        }

        return '<pre style="color:'.$this->settings['js']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightJSON($code) {

        $code = $this->trim($code);

        foreach ($this->settings['json']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'string'    => '~"[^"]*"~',     // строки в двойных кавычках
            'null'      => '~\bnull\b~',
            'bool'      => '~\btrue|false\b~',
            'digit'     => '~\b\d+\b~',    // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'json');

        return '<pre style="color:'.$this->settings['json']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightIDLE($code) {

        $code = $this->trim($code);

        foreach ($this->settings['idle']['specchars'] as $value) {
            $specchars[] = '\\'.$value;
        }

        $pattern = array(
            'comment'    => '~(?<= )# .*$~m',                // комментарий
            'command'    => '~(?<=^(\>{3}|\.{3}) ).*$~m',    // команда
            'idleprompt' => '~^(>{3}|\.{3})(?= )~m',         // приглашение
            'specchars'  => '~'.implode('|', $specchars).'~' // спец.символы
        );

        $code = $this->highlightCodeString($code, $pattern, 'idle');

        return '<pre style="color:'.$this->settings['idle']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightINI($code) {

        $code = $this->trim($code);

        $pattern = array(
            'comment' => '~^;.*~m',              // комментарии
            'string'  => '~"[^"]*"~',            // строки в двойных кавычках
            'section' => '~^\[[_a-z0-9]+\]~mi',  // начало секции
            'param'   => '~^[_a-z.]+(?= =)~im',  // параметр
            'equal'   => '~(?<= )=(?=( |$))~',   // знак =
        );

        $code = $this->highlightCodeString($code, $pattern, 'ini');

        return '<pre style="color:'.$this->settings['ini']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightMySQL($code) {

        $code = $this->trim($code);

        foreach ($this->settings['mysql']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'comment1'  => '~(?<= |^)--\s.*$~m', // комментарии
            'comment2'  => '~(?<= |^)#\s.*$~m',  // комментарии
            'comment3'  => '~/\*.*\*/~sU',       // комментарии
            'string1'   => '~"[^"]*"~',          // строки в двойных кавычках
            'string2'   => "~'[^']*'~",          // строки в одинарных кавычках
            'string3'   => '~`[^`]*`~',          // строки в обратных кавычках
            'type'      => '~\b('.implode('|', $this->settings['mysql']['type']).')\b~i', // типы данных
            'digit'     => '~\b\d+(\.\d+)?\b~',  // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'mysql');

        return '<pre style="color:'.$this->settings['mysql']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightPHP($code, $pre = true) {

        $code = $this->trim($code);

        foreach ($this->settings['php']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $super = '\$_SERVER|\$_REQUEST|\$_GET|\$_POST|\$_SISSION|\$_COOKIE';
        $pattern = array(
            'comment1'  => '~\/\/ .*$~m',  // комментарии
            'comment2'  => '~/\*.*\*/~sU', // комментарии
            'string1'   => '~"[^"]*"~',    // строки в двойных кавычках
            'string2'   => "~'[^']*'~",    // строки в одинарных кавычках
            'startphp'  => '~<\?php~',     // начало php-кода
            'startecho' => '~<\?=~',       // начало php-кода
            'shortphp'  => '~<\?~',        // начало php-кода
            'stopphp'   => '~\?>~',        // конец php-кода
            'keyword1'  => '~(?<!\$)\b('.implode('|', $this->settings['php']['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~(?<!\$)\b('.implode('|', $this->settings['php']['keyword2']).')\b~i', // ключевые слова
            'keyword3'  => '~(?<!\$)\b('.implode('|', $this->settings['php']['keyword3']).')\b~i', // ключевые слова
            'function'  => '~(?<!\->)\b('.implode('|', $this->settings['php']['function']).')\b\s?(?=\()~i', // встроенные функции
            'def-call'  => '~\b[_a-z][_a-z0-9]*\b\s?(?=\()~i', // определение или вызов функции
            'defined'   => '~\b('.implode('|', $this->settings['php']['defined']).')\b~i', // встроенные контстанты
            'constant'  => '~(?<!\$|\\\|>)\b([_A-Z][_A-Z0-9]*)\b(?!\\\)~', // контстанты
            'super-arr' => '~('.$super.')\b~', // супер-массивы
            'digit'     => '~\b\d+(\.\d+)?\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'php');
        
        if (!$pre) {
            return $code;
        }

        return '<pre style="color:'.$this->settings['php']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightPHTML($code) {

        $code = $this->trim($code);

        /*
         * Сначала врезаем куски php-кода, потом раскрашиваем все эти куски, потом вставляем обратно
         */
        $offset = 0;
        $source = array();
        $replace = array();
        while (preg_match('~<\?(=|php)?.*\?>~Us', $code, $match, PREG_OFFSET_CAPTURE, $offset)) {
            $item = $match[0][0];
            $offset = $match[0][1];
            $length = strlen($match[0][0]);

            $piece = $this->highlightPHP($item, false);
            $source[] = '<span style="color:'.$this->settings['php']['colors']['default']['fore'].'">' . $piece . '</span>';
            $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
            $replace[] = $rand;
            $code = substr_replace($code, $rand, $offset, $length);
            $offset = $offset + strlen($rand);
        }

        // теперь раскрашиваем html
        $code = $this->highlightHTML($code);

        // вставляем куски php-кода обратно
        $source = array_reverse($source);
        $replace = array_reverse($replace);
        if (!empty($source)) {
            $code = str_replace($replace, $source, $code);
        }

        return $code;

    }

    public function highlightPython($code) {

        $code = $this->trim($code);

        foreach ($this->settings['python']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'comment'   => '~# .*$~m',             // комментарии
            'string3'   => '~""".*?"""~s',         // строки в тройных кавычках
            'string4'   => "~'''.*?'''~s",         // строки в тройных кавычках
            'string1'   => '~[ru]{0,2}"[^"]*"~',   // строки в двойных кавычках
            'string2'   => "~[ru]{0,2}'[^']*'~",   // строки в одинарных кавычках
            'keyword1'  => '~\b('.implode('|', $this->settings['python']['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings['python']['keyword2']).')\b~i', // ключевые слова
            'function'  => '~(?<!\.)\b('.implode('|', $this->settings['python']['function']).')(?=\()~i', // встроенные функции
            'digit'     => '~\b\d+\b~',            // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'python');

        return '<pre style="color:'.$this->settings['python']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightQuery($code) {

        $code = $this->trim($code);

        foreach ($this->settings['query']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'string'    => '~"[^"]*"~',  // строки
            'comment'   => '~\/\/.*$~m', // комментарии
            'property'  => '~(?<=\{)[^}{]*(?=\})~',   // характеристики
            'keyword1'  => '~\b('.implode('|', $this->settings['query']['keyword1']).')\b(?= |,|$)~mu', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings['query']['keyword2']).')\b(?= |$)~mui',  // ключевые слова
            'function'  => '~\b('.implode('|', $this->settings['query']['function']).')(?=\()~ui', // функции
            'parameter' => '~&[а-яё]+\b~ui', // параметр
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'query');

        return '<pre style="color:'.$this->settings['query']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightXML($code) {

        $code = $this->trim($code);

        $pattern = array(
            'xmldecl'   => '~<\?xml[^>]*>~',                       // <?xml version="1.0" encoding="utf-8"...>
            'comment'   => '~<\!--.*-->~sU',                       // комментарии
            'attrname'  => '~(?<= )[-a-zA-Zа-яА-Я0-9:]+(?=\=")~u', // имя атрибут тега
            'attrvalue' => '~(?<=\=)"[^"]*"(?=(\s|/|>))~',         // значение атрибут тега
            'element'   => '~</?[a-zA-Zа-яА-Я0-9]+[^>]*>~u',       // открывающие и закрывающие теги
            'entity'    => '~&[a-z]+;~',                           // html-сущности
        );

        $code = $this->highlightCodeString($code, $pattern, 'xml');

        return '<pre style="color:'.$this->settings['xml']['colors']['default']['fore'].'">' . $code . '</pre>';
    }

    private function highlightCodeString($code, $pattern, $lang) {

        // заменяем экранированные кавычки на непечатные символы, чтобы правильно раскрашивать код
        $code = str_replace("\\'", chr(11).chr(11), $code);
        $code = str_replace('\\"', chr(12).chr(12), $code);
        // заменяем экранированный прямой слэш на непечатные символы, чтобы правильно раскрашивать код
        $code = str_replace("\\/", chr(15).chr(15), $code);
        // заменяем одинарные кавычки внутри двойных и двойные внутри одинарных, чтобы правильно раскрашивать код
        $code = $this->replaceQuoteInString($code);

        $source = array();
        $replace = array();
        foreach ($pattern as $color => $regexp) {

            $offset = 0;
            while (preg_match($regexp, $code, $match, PREG_OFFSET_CAPTURE, $offset)) {

                $item = $match[0][0];
                $offset = $match[0][1];
                $length = strlen($match[0][0]);
                $piece = str_replace(array('&', '>', '<'), array('&amp;', '&gt;', '&lt;'), $match[0][0]);

                $styles = array();
                if (isset($this->settings[$lang]['colors'][$color]['fore'])) {
                    $styles[] = 'color:'.$this->settings[$lang]['colors'][$color]['fore'];
                }
                if (isset($this->settings[$lang]['colors'][$color]['back'])) {
                    $styles[] = 'background:'.$this->settings[$lang]['colors'][$color]['back'];
                }
                if (isset($this->settings[$lang]['colors'][$color]['border'])) {
                    $styles[] = 'border:1px solid '.$this->settings[$lang]['colors'][$color]['border'];
                }
                $style = '';
                if (!empty($styles)) {
                    $style = implode(';', $styles);
                }
                if (!empty($style)) {
                    $source[] = '<span style="' . $style . '">' . $piece . '</span>';
                } else {
                    $source[] = $piece;
                }
                $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $replace[] = $rand;
                $code = substr_replace($code, $rand, $offset, $length);
                $offset = $offset + strlen($rand);

            }

        }

        $source = array_reverse($source);
        $replace = array_reverse($replace);

        if (!empty($source)) {
            $code = str_replace($replace, $source, $code);
        }

        // заменяем непечатные символы обратно на экранированные кавычки
        $code = str_replace(chr(11).chr(11), "\\'", $code);
        $code = str_replace(chr(12).chr(12), '\\"', $code);
        // заменяем непечатные символы обратно на экранированный прямой слэш
        $code = str_replace(chr(15).chr(15), "\\/", $code);
        // замена непечатных символов обратно на кавычки, см. метод replaceQuoteInString()
        $code = str_replace(chr(13), "'", $code);
        $code = str_replace(chr(14), '"', $code);
        
        return $code;

    }
    
    private function trim($code) {

        $code = str_replace("\r\n", "\n", $code);
        $code = str_replace("\t", '    ', $code);
        $code = trim($code, "\n");

        return $code;

    }

    /**
     * Нумерация строк кода
     */
    private function number() {

        $lines = explode("\n", $this->code);
        $res = array();
        $number = 1;
        foreach($lines as $line) {
            $num = $number;
            if (strlen($number) == 1) {
                $num = '  '.$number;
            }
            if (strlen($number) == 2) {
                $num = ' '.$number;
            }
            $res[] = '<span style="color:'.$this->settings[$this->lang]['colors']['number'].'; font-size:12px">'.($num).'</span>  '.$line;
            $number++;
        }
        $this->code = implode("\r\n", $res);

    }

    /**
     * Заменяет двойную/одинарную кавычку внутри строки в одинарных/двойных кавычках
     */
    private function replaceQuoteInString($code) {
        /*
         * Находим в строке кода первую кавычку (одинарную или двойную), потом от этого места
         * находим вторую кавычку, потом от этого места находим третью и так далее. Задача в
         * том, чтобы определить, когда одинарная кавычка находится внутри строки в двойных
         * кавычках. И когда двойная кавычка находится внутри строки в одинарных кавычках.
         * Кавычки внутри строки заменяем на непечатные символы, чтобы правильно раскрасить
         * код. А когда раскраска сделана, непечатные символы заменяются обратно на кавычки.
         */
        $offset = 0; // сдвиг от начала строки кода, который надо раскрасить
        $singleQuoteString = false; // признак того, что мы внутри строки в одинарных кавычках
        $doubleQuoteString = false; // признак того, что мы внутри строки в двойных кавычках
        while (preg_match('~[\'"]~', $code, $match, PREG_OFFSET_CAPTURE, $offset)) {
            $position = $match[0][1]; // позиция вождения очередной одинарной или двойной кавычки
            $quote = $match[0][0]; // собственно, сам символ кавычки (двойной или одинарной)
            /*
             * Возможны три варианта:
             * 1. Мы внутри строки в одинарных кавычках
             * 2. Мы внутри строки в двойных кавычках
             * 3. Ни первое, ни второе
             */
            if (false === $singleQuoteString && false === $doubleQuoteString) { // третий случай
                if ($quote === '"') { // ситуация изменилась, теперь это второй случай
                    $doubleQuoteString = true;
                }
                if ($quote === "'") { // ситуация изменилась, теперь это первый случай
                    $singleQuoteString = true;
                }
            } elseif ($doubleQuoteString) { // второй случай, мы внутри строки в двойных кавычках
                // если мы встретили двойную кавычку, это означает, что строка "..." здесь заканчивается
                if ($quote === '"') {
                    $doubleQuoteString = false;
                }
                // если мы встретили одинарную кавычку, заменяем ее, чтобы не было коллизий при подсветке
                if ($quote === "'") {
                    $code = substr_replace($code, chr(13), $position, 1);
                }
            } elseif ($singleQuoteString) { // третий случай, мы внутри строки в одинарных кавычках
                // если мы встретили одинарную кавычку, это означает, что строка '...' здесь заканчивается
                if ($quote === "'") {
                    $singleQuoteString = false;
                }
                // если мы встретили двойную кавычку, заменяем ее, чтобы не было коллизий при подсветке
                if ($quote === '"') {
                    $code = substr_replace($code, chr(14), $position, 1);
                }
            }
            $offset = $position + 1; // следующий поиск кавычки уже с этой позиции
        }
        
        return $code;
    }
    
    private function collapse($code) {
        $strings = explode("\n", $code);

        foreach ($strings as $string) {
            if (iconv_substr($string, 0, 10) === 'Процедура '
                || iconv_substr($string, 0, 8) === 'Функция '
                || iconv_substr($string, 0, 9) === '#Область '
                || iconv_substr($string, 0, 13) === '    #Область ') {
                $result[] = $string . chr(5);
            } elseif (iconv_substr($string, 0, 14) === 'КонецПроцедуры'
                      || iconv_substr($string, 0, 12) === 'КонецФункции'
                      || iconv_substr($string, 0, 13) === '#КонецОбласти'
                      || iconv_substr($string, 0, 17) === '    #КонецОбласти') {
                $result[] = chr(6) . $string . "\n";
            } else {
                $result[] = $string . "\n";
            }
        }
        return implode('', $result);
    }

}