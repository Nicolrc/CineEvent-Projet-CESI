<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* base.html.twig */
class __TwigTemplate_49becbe65a5f827e522ad6540c8e8159 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'css' => [$this, 'block_css'],
            'body' => [$this, 'block_body'],
            'javascript' => [$this, 'block_javascript'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>";
        // line 8
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65\" crossorigin=\"anonymous\">
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css\" rel=\"stylesheet\" />
    <link rel=\"stylesheet\" href=\"/assets/css/style.css\">
    ";
        // line 12
        yield from $this->unwrap()->yieldBlock('css', $context, $blocks);
        // line 13
        yield "
</head>
<nav class=\"navbar navbar-expand-lg navbar-light bg-light\">

    <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
        <ul class=\"navbar-nav mr-auto\">
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/\">Accueil</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/AdminArticle/list\">Admin List</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/AdminArticle/add\">Admin Add</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/AdminArticle/fixtures\">Fixtures</a>
            </li>
        </ul>
    </div>
    <form class=\"d-flex\" method=\"post\" action=\"/Article/search\">
        <input class=\"form-control me-2\" type=\"search\" placeholder=\"Recherchez un article\"
        name=\"Search\" id=\"Search\" value=\"";
        // line 35
        yield ((array_key_exists("keyword", $context)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["keyword"] ?? null), "html", null, true)) : (""));
        yield "\">
    </form>

    ";
        // line 38
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["session"] ?? null), "login", [], "any", true, true, false, 38)) {
            // line 39
            yield "        <a class=\"btn btn-danger\" href=\"/User/logout\" role=\"button\">Log OUT</a>
    ";
        } else {
            // line 41
            yield "        <a class=\"btn btn-success\" href=\"/User/login\" role=\"button\">Log IN</a>
    ";
        }
        // line 43
        yield "

</nav>
<body>
<div class=\"container\">

    ";
        // line 49
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 50
        yield "</div>

<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4\" crossorigin=\"anonymous\"></script>
<script type=\"text/javascript\" src=\"/assets/js/script.js\"></script>
";
        // line 54
        yield from $this->unwrap()->yieldBlock('javascript', $context, $blocks);
        // line 55
        yield "
</body>
</html>
";
        yield from [];
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "BLOG CESI";
        yield from [];
    }

    // line 12
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_css(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 49
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 54
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascript(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  161 => 54,  151 => 49,  141 => 12,  130 => 8,  122 => 55,  120 => 54,  114 => 50,  112 => 49,  104 => 43,  100 => 41,  96 => 39,  94 => 38,  88 => 35,  64 => 13,  62 => 12,  55 => 8,  46 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>{% block title %}BLOG CESI{% endblock %}</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65\" crossorigin=\"anonymous\">
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css\" rel=\"stylesheet\" />
    <link rel=\"stylesheet\" href=\"/assets/css/style.css\">
    {% block css %}{% endblock %}

</head>
<nav class=\"navbar navbar-expand-lg navbar-light bg-light\">

    <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
        <ul class=\"navbar-nav mr-auto\">
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/\">Accueil</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/AdminArticle/list\">Admin List</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/AdminArticle/add\">Admin Add</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/AdminArticle/fixtures\">Fixtures</a>
            </li>
        </ul>
    </div>
    <form class=\"d-flex\" method=\"post\" action=\"/Article/search\">
        <input class=\"form-control me-2\" type=\"search\" placeholder=\"Recherchez un article\"
        name=\"Search\" id=\"Search\" value=\"{{ keyword is defined ? keyword : \"\" }}\">
    </form>

    {% if session.login is defined %}
        <a class=\"btn btn-danger\" href=\"/User/logout\" role=\"button\">Log OUT</a>
    {% else %}
        <a class=\"btn btn-success\" href=\"/User/login\" role=\"button\">Log IN</a>
    {% endif %}


</nav>
<body>
<div class=\"container\">

    {% block body %}{% endblock %}
</div>

<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4\" crossorigin=\"anonymous\"></script>
<script type=\"text/javascript\" src=\"/assets/js/script.js\"></script>
{% block javascript %}{% endblock %}

</body>
</html>
", "base.html.twig", "/var/www/html/src/View/base.html.twig");
    }
}
