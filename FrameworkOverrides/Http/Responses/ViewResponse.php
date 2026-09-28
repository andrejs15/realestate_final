<?php

namespace Framework\Http\Responses;

use App\Configuration;
use Framework\Core\App;
use Framework\Support\View as ViewHelper;

/**
 * Source: Vaííčko Framework 3.0.6 ViewResponse.php
 * https://github.com/thevajko/vaiicko/blob/master/Framework/Http/Responses/ViewResponse.php
 *
 * Adaptation: views are resolved from this project's root /App directory because the framework
 * itself is kept as a Git submodule. The rendering behaviour is otherwise kept equivalent.
 * AI-assisted migration from the original Laravel project.
 */
class ViewResponse extends Response
{
    private App $app;
    private string $viewName;
    private array $data;

    public function __construct(App $app, string $viewName, array $data)
    {
        $this->app = $app;
        $this->viewName = $viewName;
        $this->data = $data;
    }

    protected function generate(): void
    {
        $viewHelpers = [
            'user' => $this->app->getAppUser(),
            'link' => $this->app->getLinkGenerator(),
        ];

        $selectedLayout = Configuration::ROOT_LAYOUT;
        $view = new ViewHelper($selectedLayout);
        $dataVars = $viewHelpers + $this->data + ['view' => $view];
        extract($dataVars, EXTR_SKIP);

        ob_start();
        require $this->projectRoot()
            . DIRECTORY_SEPARATOR . 'App'
            . DIRECTORY_SEPARATOR . 'Views'
            . DIRECTORY_SEPARATOR . ($this->viewName . '.view.php');
        $contentHTML = ob_get_clean();

        if ($selectedLayout !== null) {
            $layoutData = $viewHelpers + ['contentHTML' => $contentHTML];
            $this->renderView($layoutData, $this->getLayoutFullName($selectedLayout));
        } else {
            echo $contentHTML;
        }
    }

    private function renderView(array $data, string $viewPath): void
    {
        extract($data, EXTR_SKIP);
        require $this->projectRoot()
            . DIRECTORY_SEPARATOR . 'App'
            . DIRECTORY_SEPARATOR . 'Views'
            . DIRECTORY_SEPARATOR . $viewPath;
    }

    private function getLayoutFullName(string $layoutName): string
    {
        $file = str_ends_with($layoutName, '.layout.view.php')
            ? $layoutName
            : $layoutName . '.layout.view.php';

        return 'Layouts' . DIRECTORY_SEPARATOR . $file;
    }

    private function projectRoot(): string
    {
        return dirname(__DIR__, 3);
    }
}
