<?php

/* index.html.twig */
class __TwigTemplate_7821276460b3b1be0866433916642e7120ba94f93f5aab59487c8b1a9d709c64 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["active"] = "homepage";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "<div class=\"alert alert-success\">
    <strong>Nós vamos divulgar para você!</strong> Reclame agora, registre o seu problema.
</div>
<input type=\"text\" placeholder=\"Procurar Empreendimento\" class=\"form-control\">
    
";
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 5,  30 => 4,  25 => 2,);
    }
}
