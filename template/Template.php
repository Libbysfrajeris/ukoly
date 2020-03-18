<?php
class Template
{
    private $vars = array();

    public function setData($data, $value)
    {
        $this->vars[$data] = $value;
    }

    public function render($template_name)
    {
        $path = $template_name . '.html';

        if (file_exists($path)) {
            $contents = file_get_contents($path);

            foreach ($this->vars as $data => $value) {
                $contents = preg_replace('/\{' . $data . '\}/', $value, $contents);
            }

            eval(' ?>' . $contents . '<?php');
        } else {
            exit('<h1>Template Error</h1>');
        }
    }
}
