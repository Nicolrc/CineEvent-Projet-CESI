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

/* contact/index.html.twig */
class __TwigTemplate_2e92dca0a636a2159de9f0203784c1a5 extends Template
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
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield " - Contactez nous";
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
        yield "    <h1>Formulaire de contact</h1>

    <form name=\"contact\" method=\"post\" enctype=\"multipart/form-data\" action=\"/Contact/send\">
        <input type=\"text\" name=\"nom\" required placeholder=\"Votre nom\" class=\"form-control\">
        <input type=\"email\" name=\"mail\" required placeholder=\"Votre mail\" class=\"form-control\">
        <textarea name=\"message\" class=\"form-control\">Votre message</textarea>
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
        return "contact/index.html.twig";
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
{% block title %}{{ parent() }} - Contactez nous{% endblock %}

{% block body %}
    <h1>Formulaire de contact</h1>

    <form name=\"contact\" method=\"post\" enctype=\"multipart/form-data\" action=\"/Contact/send\">
        <input type=\"text\" name=\"nom\" required placeholder=\"Votre nom\" class=\"form-control\">
        <input type=\"email\" name=\"mail\" required placeholder=\"Votre mail\" class=\"form-control\">
        <textarea name=\"message\" class=\"form-control\">Votre message</textarea>
        <button type=\"submit\" class=\"btn btn-primary\">Valider</button>
    </form>

{% endblock %}
", "contact/index.html.twig", "/var/www/html/src/View/contact/index.html.twig");
    }
}
