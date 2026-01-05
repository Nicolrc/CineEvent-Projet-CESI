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

/* article/show.html.twig */
class __TwigTemplate_ccfd67b0978d50876c4b5be8845a6dbe extends Template
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
        yield " Article ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "titre", [], "any", false, false, false, 2), "html", null, true);
        yield " - ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield from [];
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "    <h1>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "titre", [], "any", false, false, false, 4), "html", null, true);
        yield "</h1>
    <p><strong>Description :</strong>";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "description", [], "any", false, false, false, 5), "html", null, true);
        yield "</p>
    <p><strong>Auteur :</strong>";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "Auteur", [], "any", false, false, false, 6), "html", null, true);
        yield "</p>
    <p><strong>Date :</strong>";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "date", [], "any", false, false, false, 7), "d/m/Y"), "html", null, true);
        yield "</p>
    <p>

        ";
        // line 10
        if (($this->env->getFunction('file_exists')->getCallable()(((("./uploads/images/" . CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageRepository", [], "any", false, false, false, 10)) . "/") . CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageFileName", [], "any", false, false, false, 10))) && (CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageFileName", [], "any", false, false, false, 10) != ""))) {
            // line 11
            yield "            <img src=\"/uploads/images/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageRepository", [], "any", false, false, false, 11), "html", null, true);
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageFileName", [], "any", false, false, false, 11), "html", null, true);
            yield "\"
                 class=\"img-thumbnail\"/>
        ";
        }
        // line 14
        yield "    </p>

    <a href=\"/Article/pdf/";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "id", [], "any", false, false, false, 16), "html", null, true);
        yield "\">PDF</a>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "article/show.html.twig";
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
        return array (  107 => 16,  103 => 14,  94 => 11,  92 => 10,  86 => 7,  82 => 6,  78 => 5,  73 => 4,  66 => 3,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}
{% block title %} Article {{ article.titre}} - {{ parent() }}{% endblock %}
{% block body %}
    <h1>{{ article.titre }}</h1>
    <p><strong>Description :</strong>{{ article.description }}</p>
    <p><strong>Auteur :</strong>{{ article.Auteur }}</p>
    <p><strong>Date :</strong>{{ article.date|date(\"d/m/Y\") }}</p>
    <p>

        {% if file_exists('./uploads/images/'~article.ImageRepository~'/'~article.ImageFileName) and article.ImageFileName != \"\"%}
            <img src=\"/uploads/images/{{ article.ImageRepository }}/{{ article.ImageFileName }}\"
                 class=\"img-thumbnail\"/>
        {% endif %}
    </p>

    <a href=\"/Article/pdf/{{ article.id }}\">PDF</a>
{%  endblock %}", "article/show.html.twig", "/var/www/html/src/View/article/show.html.twig");
    }
}
