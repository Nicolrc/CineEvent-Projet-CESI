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

/* article/pdf.html.twig */
class __TwigTemplate_060dca2e2c2bd43af6297790d3bf623e extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<h1>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "titre", [], "any", false, false, false, 1), "html", null, true);
        yield "</h1>
<p><strong>Description :</strong>";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "description", [], "any", false, false, false, 2), "html", null, true);
        yield "</p>
<p><strong>Auteur :</strong>";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "Auteur", [], "any", false, false, false, 3), "html", null, true);
        yield "</p>
<p><strong>Date :</strong>";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "date", [], "any", false, false, false, 4), "d/m/Y"), "html", null, true);
        yield "</p>
<p>

    ";
        // line 7
        if (($this->env->getFunction('file_exists')->getCallable()(((("./uploads/images/" . CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageRepository", [], "any", false, false, false, 7)) . "/") . CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageFileName", [], "any", false, false, false, 7))) && (CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageFileName", [], "any", false, false, false, 7) != ""))) {
            // line 8
            yield "        <img src=\"/uploads/images/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageRepository", [], "any", false, false, false, 8), "html", null, true);
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "ImageFileName", [], "any", false, false, false, 8), "html", null, true);
            yield "\" class=\"img-thumbnail\"/>
    ";
        }
        // line 10
        yield "</p>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "article/pdf.html.twig";
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
        return array (  71 => 10,  63 => 8,  61 => 7,  55 => 4,  51 => 3,  47 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<h1>{{ article.titre }}</h1>
<p><strong>Description :</strong>{{ article.description }}</p>
<p><strong>Auteur :</strong>{{ article.Auteur }}</p>
<p><strong>Date :</strong>{{ article.date|date(\"d/m/Y\") }}</p>
<p>

    {% if file_exists('./uploads/images/'~article.ImageRepository~'/'~article.ImageFileName) and article.ImageFileName != \"\" %}
        <img src=\"/uploads/images/{{ article.ImageRepository }}/{{ article.ImageFileName }}\" class=\"img-thumbnail\"/>
    {% endif %}
</p>", "article/pdf.html.twig", "/var/www/html/src/View/article/pdf.html.twig");
    }
}
