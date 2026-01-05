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

/* admin/article/edit.html.twig */
class __TwigTemplate_9d27780dcd9c62a52a0accda84d0ed79 extends Template
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
        yield "ADMIN - ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield " - Mise à d'un Article ";
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
        yield "    <h1>Mise à jour Article</h1>

    <form method=\"post\" enctype=\"multipart/form-data\">

        <div class=\"mb-3\">
            <input type=\"text\" class=\"form-control\" placeholder=\"Saisir un titre\" name=\"Titre\" value=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "Titre", [], "any", false, false, false, 10), "html", null, true);
        yield "\">
        </div>

        <div class=\"mb-3\">
            <textarea class=\"form-control\" name=\"Description\" rows=\"3\">";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "Description", [], "any", false, false, false, 14), "html", null, true);
        yield "</textarea>
        </div>

        <div class=\"mb-3\">
            <input type=\"date\" class=\"form-control\" name=\"DatePublication\" value=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "DatePublication", [], "any", false, false, false, 18), "Y-m-d"), "html", null, true);
        yield "\">
        </div>

        <div class=\"mb-3\">
            <select class=\"form-select\" name=\"Auteur\">
                <option value=\"Enzo\"";
        // line 23
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "Auteur", [], "any", false, false, false, 23) == "Enzo")) {
            yield " selected ";
        }
        yield ">Enzo</option>
                <option value=\"Bastien\" ";
        // line 24
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "Auteur", [], "any", false, false, false, 24) == "Bastien")) {
            yield " selected ";
        }
        yield ">Bastien</option>
                <option value=\"Camille\" ";
        // line 25
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "Auteur", [], "any", false, false, false, 25) == "Camille")) {
            yield " selected ";
        }
        yield ">Camille</option>
                <option value=\"Denis\" ";
        // line 26
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "Auteur", [], "any", false, false, false, 26) == "Denis")) {
            yield " selected ";
        }
        yield ">Denis</option>
            </select>
        </div>

        <div class=\"mb-3\">
            <input type=\"file\" class=\"custom-file-input\" name=\"Image\">
        </div>

        ";
        // line 34
        if (($this->env->getFunction('file_exists')->getCallable()(((("./uploads/images/" . CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageRepository", [], "any", false, false, false, 34)) . "/") . CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageFileName", [], "any", false, false, false, 34))) && (CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageFileName", [], "any", false, false, false, 34) != ""))) {
            // line 35
            yield "            <img src=\"/uploads/images/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageRepository", [], "any", false, false, false, 35), "html", null, true);
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageFileName", [], "any", false, false, false, 35), "html", null, true);
            yield "\"
                 class=\"img-thumbnail\"/>
        ";
        }
        // line 38
        yield "
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
        return "admin/article/edit.html.twig";
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
        return array (  143 => 38,  134 => 35,  132 => 34,  119 => 26,  113 => 25,  107 => 24,  101 => 23,  93 => 18,  86 => 14,  79 => 10,  72 => 5,  65 => 4,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}
{% block title %}ADMIN - {{ parent() }} - Mise à d'un Article {% endblock %}

{% block body %}
    <h1>Mise à jour Article</h1>

    <form method=\"post\" enctype=\"multipart/form-data\">

        <div class=\"mb-3\">
            <input type=\"text\" class=\"form-control\" placeholder=\"Saisir un titre\" name=\"Titre\" value=\"{{ article.Titre }}\">
        </div>

        <div class=\"mb-3\">
            <textarea class=\"form-control\" name=\"Description\" rows=\"3\">{{ article.Description }}</textarea>
        </div>

        <div class=\"mb-3\">
            <input type=\"date\" class=\"form-control\" name=\"DatePublication\" value=\"{{ article.DatePublication|date(\"Y-m-d\") }}\">
        </div>

        <div class=\"mb-3\">
            <select class=\"form-select\" name=\"Auteur\">
                <option value=\"Enzo\"{% if (article.Auteur==\"Enzo\") %} selected {% endif %}>Enzo</option>
                <option value=\"Bastien\" {% if (article.Auteur==\"Bastien\") %} selected {% endif %}>Bastien</option>
                <option value=\"Camille\" {% if (article.Auteur==\"Camille\") %} selected {% endif %}>Camille</option>
                <option value=\"Denis\" {% if (article.Auteur==\"Denis\") %} selected {% endif %}>Denis</option>
            </select>
        </div>

        <div class=\"mb-3\">
            <input type=\"file\" class=\"custom-file-input\" name=\"Image\">
        </div>

        {% if file_exists('./uploads/images/'~article.ImageRepository~'/'~article.ImageFileName) and article.ImageFileName != \"\"%}
            <img src=\"/uploads/images/{{ article.ImageRepository }}/{{ article.ImageFileName }}\"
                 class=\"img-thumbnail\"/>
        {% endif %}

        <button type=\"submit\" class=\"btn btn-primary\">Valider</button>
    </form>


{% endblock %}", "admin/article/edit.html.twig", "/var/www/html/src/View/admin/article/edit.html.twig");
    }
}
