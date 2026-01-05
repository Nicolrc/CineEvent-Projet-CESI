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

/* user/create.html.twig */
class __TwigTemplate_094a713276d51117273f50eb17005d98 extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Création compte - ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 5
        yield "    <h1>Création d'un compte utilisateur</h1>

    <form method=\"post\">

        <div class=\"mb-3\">
            <input type=\"email\" class=\"form-control\" placeholder=\"Votre mail\" name=\"mail\">
        </div>

        <div class=\"mb-3\">
            <input type=\"text\" class=\"form-control\" placeholder=\"Votre Nom + Prénom\" name=\"nom\">
        </div>

        <div class=\"mb-3\">
            <input type=\"password\" class=\"form-control\" placeholder=\"mot de passe\" name=\"password\">
        </div>


        <div class=\"mb-3\">
            <select class=\"form-select\" name=\"roles[]\" multiple>
                <option value=\"Administrateur\">Administrateur</option>
                <option value=\"Redacteur\">Redacteur</option>
                <option value=\"Verificateur\">Vérificateur</option>
            </select>
        </div>

        <button type=\"submit\" class=\"btn btn-primary\">Valider</button>
    </form>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "user/create.html.twig";
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
        return array (  71 => 5,  64 => 4,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}
{% block title %}Création compte - {{ parent() }}{% endblock %}

{% block body %}
    <h1>Création d'un compte utilisateur</h1>

    <form method=\"post\">

        <div class=\"mb-3\">
            <input type=\"email\" class=\"form-control\" placeholder=\"Votre mail\" name=\"mail\">
        </div>

        <div class=\"mb-3\">
            <input type=\"text\" class=\"form-control\" placeholder=\"Votre Nom + Prénom\" name=\"nom\">
        </div>

        <div class=\"mb-3\">
            <input type=\"password\" class=\"form-control\" placeholder=\"mot de passe\" name=\"password\">
        </div>


        <div class=\"mb-3\">
            <select class=\"form-select\" name=\"roles[]\" multiple>
                <option value=\"Administrateur\">Administrateur</option>
                <option value=\"Redacteur\">Redacteur</option>
                <option value=\"Verificateur\">Vérificateur</option>
            </select>
        </div>

        <button type=\"submit\" class=\"btn btn-primary\">Valider</button>
    </form>
{% endblock %}
", "user/create.html.twig", "/var/www/html/src/View/user/create.html.twig");
    }
}
