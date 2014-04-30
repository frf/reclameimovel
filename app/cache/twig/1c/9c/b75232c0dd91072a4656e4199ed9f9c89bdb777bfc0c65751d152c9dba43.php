<?php

/* layout.html.twig */
class __TwigTemplate_1c9cb75232c0dd91072a4656e4199ed9f9c89bdb777bfc0c65751d152c9dba43 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'secondaryNavigation' => array($this, 'block_secondaryNavigation'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"description\" content=\"Administração de Conteúdo\">
        <meta name=\"author\" content=\"Fabio Rocha\">

        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <meta name=\"language\" content=\"pt\" />

        <!-- Bootstrap core CSS -->
        <link href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/css/bootstrap.min.css\" rel=\"stylesheet\">
        <!-- Bootstrap theme -->
        <link href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/css/bootstrap-theme.min.css\" rel=\"stylesheet\">

        <!-- Custom styles for this template -->
        <link href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/css/theme.css\" rel=\"stylesheet\">
        <link href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/css/footer.css\" rel=\"stylesheet\">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src=\"<?php echo Yii::app()->request->baseUrl; ?>/js/ie8-responsive-file-warning.js\"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
          <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->
        <title>";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Reclame Empreendimento"), "html", null, true);
        echo "</title>        
    </head>
<body role=\"document\">
    ";
        // line 33
        $context["active"] = ((array_key_exists("active", $context)) ? (_twig_default_filter((isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")), null)) : (null));
        // line 34
        echo "    <div role=\"navigation\" class=\"navbar navbar-inverse navbar-fixed-top\">
      <div class=\"container\">
        <div class=\"navbar-header\">
          <button data-target=\".navbar-collapse\" data-toggle=\"collapse\" class=\"navbar-toggle\" type=\"button\">
            <span class=\"sr-only\">Toggle navigation</span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
          <a href=\"#\" class=\"navbar-brand\">Reclame Empreendimento</a>
        </div>
        <div class=\"navbar-collapse collapse\">
          <ul class=\"nav navbar-nav\">
            <li ";
        // line 47
        if (("homepage" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('routing')->getPath("homepage");
        echo "\"><i class=\"icon-home\"></i>  ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Home"), "html", null, true);
        echo "</a></li>
            
            <li><a href=\"#about\">Morador</a></li>            
            <li><a href=\"#contact\">Construtora</a></li>
            
            <!--
            
            ";
        // line 54
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 55
            echo "                <li ";
            if (("me" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
                echo "class=\"active\"";
            }
            echo "><a href=\"";
            echo $this->env->getExtension('routing')->getPath("me");
            echo "\"><i class=\"icon-user\"></i> My Profile</a></li>
                <li><a href=\"";
            // line 56
            echo $this->env->getExtension('routing')->getPath("logout");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Logout"), "html", null, true);
            echo "</a></li>
            ";
        } else {
            // line 58
            echo "                <li ";
            if (("login" == (isset($context["active"]) ? $context["active"] : $this->getContext($context, "active")))) {
                echo "class=\"active\"";
            }
            echo "><a href=\"";
            echo $this->env->getExtension('routing')->getPath("login");
            echo "\"><i class=\"icon-user\"></i> ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Login"), "html", null, true);
            echo "</a></li>
            ";
        }
        // line 60
        echo "            
            -->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!-- Begin page content -->
    <div class=\"container\">      
        ";
        // line 68
        $this->displayBlock('secondaryNavigation', $context, $blocks);
        // line 70
        echo "        ";
        $this->displayBlock('content', $context, $blocks);
        // line 72
        echo "    </div>
    
    <div id=\"footer\">
      <div class=\"container\">
          <p style=\"text-align: center\" class=\"text-muted\"><a href=\"http://fsitecnologia.com.br\">FSITecnologia</a></p>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src=\"";
        // line 83
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/jquery-2.0.3.min.js\"></script>
    <script src=\"";
        // line 84
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/bootstrap.min.js\"></script>
    <script src=\"";
        // line 85
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/js/docs.min.js\"></script>

</body>
</html>
";
    }

    // line 68
    public function block_secondaryNavigation($context, array $blocks = array())
    {
        // line 69
        echo "        ";
    }

    // line 70
    public function block_content($context, array $blocks = array())
    {
        // line 71
        echo "        ";
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  188 => 71,  185 => 70,  181 => 69,  178 => 68,  169 => 85,  165 => 84,  161 => 83,  148 => 72,  145 => 70,  143 => 68,  133 => 60,  121 => 58,  114 => 56,  105 => 55,  103 => 54,  87 => 47,  72 => 34,  70 => 33,  64 => 30,  51 => 20,  47 => 19,  41 => 16,  36 => 14,  21 => 1,  33 => 5,  30 => 4,  25 => 2,);
    }
}
