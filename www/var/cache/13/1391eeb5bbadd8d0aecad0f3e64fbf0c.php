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

/* article/search.html.twig */
class __TwigTemplate_c33034c33af529fd2948ffec7bdafef2 extends Template
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
        // line 2
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("base.html.twig", 2);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield " > Résultat de la recherche ";
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "    <h1>Résutats pour la recherche : ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["keyword"] ?? null), "html", null, true);
        yield "</h1>
    <table class=\"table\">
        <thead>
        <tr>
            <th scope=\"col\">Titre</th>
            <th scope=\"col\">Date de Publication</th>
            <th scope=\"col\">Auteur</th>
        </tr>
        </thead>
        <tbody>
        ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["articles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 18
            yield "            <tr>
                <td><a href=\"?controller=Article&action=show&param=";
            // line 19
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 19), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "Titre", [], "any", false, false, false, 19), "html", null, true);
            yield "</a></td>
                <td>";
            // line 20
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "DatePublication", [], "any", false, false, false, 20), "d/m/Y"), "html", null, true);
            yield "</td>
                <td>";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "Auteur", [], "any", false, false, false, 21), "html", null, true);
            yield "</td>

            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['article'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        yield "        </tbody>
    </table>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "article/search.html.twig";
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
        return array (  112 => 25,  102 => 21,  98 => 20,  92 => 19,  89 => 18,  85 => 17,  71 => 7,  64 => 6,  52 => 4,  41 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("
{% extends \"base.html.twig\" %}

{% block title %}{{ parent() }} > Résultat de la recherche {% endblock %}

{% block body %}
    <h1>Résutats pour la recherche : {{ keyword }}</h1>
    <table class=\"table\">
        <thead>
        <tr>
            <th scope=\"col\">Titre</th>
            <th scope=\"col\">Date de Publication</th>
            <th scope=\"col\">Auteur</th>
        </tr>
        </thead>
        <tbody>
        {% for article in articles %}
            <tr>
                <td><a href=\"?controller=Article&action=show&param={{ article.id }}\">{{ article.Titre }}</a></td>
                <td>{{ article.DatePublication|date('d/m/Y') }}</td>
                <td>{{ article.Auteur }}</td>

            </tr>
        {% endfor %}
        </tbody>
    </table>
{% endblock %}", "article/search.html.twig", "/var/www/html/src/View/article/search.html.twig");
    }
}
