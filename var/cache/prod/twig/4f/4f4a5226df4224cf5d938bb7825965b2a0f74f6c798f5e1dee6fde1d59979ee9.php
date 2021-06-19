<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @Product/ProductPage/Panels/options.html.twig */
class __TwigTemplate_bd6a6c0dc55f00d2b47984d5cf8dda3b535b321ccf1cf8aadd79a19934164da9 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            '__internal_ee9237ed8c9ac932d270da9a19e842456b27f3845e3d80121d39ccee5928e9a0' => [$this, 'block___internal_ee9237ed8c9ac932d270da9a19e842456b27f3845e3d80121d39ccee5928e9a0'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 25
        echo "<div role=\"tabpanel\" class=\"form-contenttab tab-pane\" id=\"step6\">
  <div class=\"row\">
    <div class=\"col-md-12\">
      <div class=\"container-fluid\">
        <div class=\"row\">

          <div class=\"col-md-12\">

            ";
        // line 33
        echo $this->env->getExtension('PrestaShopBundle\Twig\HookExtension')->renderHook("displayAdminProductsOptionsStepTop", ["id_product" => ($context["productId"] ?? null)]);
        echo "

            <div class=\"row\">
              <div class=\"col-md-12\">
                <h2>";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Visibility", [], "Admin.Catalog.Feature"), "html", null, true);
        echo "</h2>
                <p class=\"subtitle\">";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Where do you want your product to appear?", [], "Admin.Catalog.Feature"), "html", null, true);
        echo "</p>
              </div>
            </div>

            <div class=\"row\">
              <div class=\"col-md-4 form-group\">
                ";
        // line 44
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "visibility", []), 'errors');
        echo "
                ";
        // line 45
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "visibility", []), 'widget');
        echo "
              </div>
            </div>

            <div class=\"row\">
              <div class=\"col-md-7 form-group\">
                  ";
        // line 51
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "display_options", []), 'errors');
        echo "
                  <div class=\"row\">
                    <div class=\"col-md-4 js-available-for-order\">
                      ";
        // line 54
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "display_options", []), "available_for_order", []), 'widget');
        echo "
                    </div>
                    <div class=\"col-md-3 js-show-price\">
                      ";
        // line 57
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "display_options", []), "show_price", []), 'widget');
        echo "
                    </div>
                    <div class=\"col-md-5\">
                      ";
        // line 60
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "display_options", []), "online_only", []), 'widget');
        echo "
                    </div>
                  </div>
              </div>
            </div>
            <div class=\"row form-group\">
              <div class=\"col-md-8\">
                <label class=\"form-control-label\">";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Tags", [], "Admin.Catalog.Feature"), "html", null, true);
        echo "</label>
                ";
        // line 68
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "tags", []), 'errors');
        echo "
                ";
        // line 69
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "tags", []), 'widget');
        echo "
                <div class=\"alert expandable-alert alert-info mt-3\" role=\"alert\">
                  <button type=\"button\" class=\"read-more btn-link\" data-toggle=\"collapse\" data-target=\"#tagsInfo\" aria-expanded=\"false\" aria-controls=\"collapseDanger\">
                    ";
        // line 72
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Read more", [], "Admin.Actions");
        echo "
                  </button>
                  <p class=\"alert-text\">";
        // line 74
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Tags are meant to help your customers find your products via the search bar.", [], "Admin.Catalog.Help");
        echo "</p>
                  <div class=\"alert-more collapse\" id=\"tagsInfo\">
                    <p>
                      ";
        // line 77
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Choose terms and keywords that your customers will use to search for this product and make sure you are consistent with the tags you may have already used.", [], "Admin.Catalog.Help");
        echo "<br>
                      ";
        // line 78
        echo twig_replace_filter($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("You can manage tag aliases in the [1]Search section[/1]. If you add new tags, you have to rebuild the index.", [], "Admin.Catalog.Help"), ["[1]" => (("<a href=\"" . $this->env->getExtension('PrestaShopBundle\Twig\LayoutExtension')->getAdminLink("AdminSearchConf")) . "\" target=\"_blank\">"), "[/1]" => "</a>"]);
        // line 83
        echo "
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class=\"row\">
              <div class=\"col-md-12\">
                <h2>";
        // line 92
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Condition & References", [], "Admin.Catalog.Feature");
        echo "</h2>
              </div>
            </div>

            <div class=\"row\">
              <fieldset class=\"col-md-4 form-group\">
                <label class=\"form-control-label\">
                  ";
        // line 99
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "condition", []), "vars", []), "label", []), "html", null, true);
        echo "
                  <span class=\"help-box\" data-toggle=\"popover\"
                    data-content=\"";
        // line 101
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Not all shops sell new products. This option enables you to indicate the condition of the product. It can be required on some marketplaces.", [], "Admin.Catalog.Help"), "html", null, true);
        echo "\" ></span>
                </label>
                ";
        // line 103
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "condition", []), 'errors');
        echo "
                ";
        // line 104
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "condition", []), 'widget');
        echo "
              </fieldset>
              <fieldset class=\"col-md-4 form-group\">
                <label class=\"form-control-label\">&nbsp;</label>
                ";
        // line 108
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "show_condition", []), 'widget');
        echo "
              </fieldset>
            </div>
            <div class=\"row\">
              <fieldset class=\"col-md-4 form-group\">
                <label class=\"form-control-label\">
                  ";
        // line 114
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "isbn", []), "vars", []), "label", []), "html", null, true);
        echo "
                  <span class=\"help-box\" data-toggle=\"popover\"
                    data-content=\"";
        // line 116
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("ISBN is used internationally to identify books and their various editions.", [], "Admin.Catalog.Help"), "html", null, true);
        echo "\" ></span>
                </label>
                ";
        // line 118
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "isbn", []), 'errors');
        echo "
                ";
        // line 119
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "isbn", []), 'widget');
        echo "
              </fieldset>
              <fieldset class=\"col-md-4 form-group\">
                <label class=\"form-control-label\">
                  ";
        // line 123
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "ean13", []), "vars", []), "label", []), "html", null, true);
        echo "
                  <span class=\"help-box\" data-toggle=\"popover\"
                    data-content=\"";
        // line 125
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("This type of product code is specific to Europe and Japan, but is widely used internationally. It is a superset of the UPC code: all products marked with an EAN will be accepted in North America.", [], "Admin.Catalog.Help"), "html", null, true);
        echo "\" ></span>
                </label>
                ";
        // line 127
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "ean13", []), 'errors');
        echo "
                ";
        // line 128
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "ean13", []), 'widget');
        echo "
              </fieldset>
            </div>
            <div class=\"row\">
              <fieldset class=\"col-md-4 form-group\">
                <label class=\"form-control-label\">
                  ";
        // line 134
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "upc", []), "vars", []), "label", []), "html", null, true);
        echo "
                  <span class=\"help-box\" data-toggle=\"popover\"
                    data-content=\"";
        // line 136
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("This type of product code is widely used in the United States, Canada, the United Kingdom, Australia, New Zealand and in other countries.", [], "Admin.Catalog.Help"), "html", null, true);
        echo "\" ></span>
                </label>
                ";
        // line 138
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "upc", []), 'errors');
        echo "
                ";
        // line 139
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "upc", []), 'widget');
        echo "
              </fieldset>
              <fieldset class=\"col-md-4 form-group\">
                <label class=\"form-control-label\">
                  ";
        // line 143
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "mpn", []), "vars", []), "label", []), "html", null, true);
        echo "
                  <span class=\"help-box\" data-toggle=\"popover\"
                        data-content=\"";
        // line 145
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("MPN is used internationally to identify the Manufacturer Part Number.", [], "Admin.Catalog.Help"), "html", null, true);
        echo "\" ></span>
                </label>
                ";
        // line 147
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "mpn", []), 'errors');
        echo "
                ";
        // line 148
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "mpn", []), 'widget');
        echo "
              </fieldset>
            </div>

            <div class=\"row\">
              <div class=\"col-md-12\">
                <div id=\"custom_fields\" class=\"mt-3\">
                  <h2>";
        // line 155
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "custom_fields", []), "vars", []), "label", []), "html", null, true);
        echo "</h2>
                  <p class=\"subtitle\">";
        // line 156
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Customers can personalize the product by entering some text or by providing custom image files.", [], "Admin.Catalog.Feature"), "html", null, true);
        echo "</p>
                  ";
        // line 157
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "custom_fields", []), 'errors');
        echo "
                  <ul class=\"customFieldCollection nostyle\" data-prototype=\"
                              ";
        // line 159
        echo twig_escape_filter($this->env,         $this->renderBlock("__internal_ee9237ed8c9ac932d270da9a19e842456b27f3845e3d80121d39ccee5928e9a0", $context, $blocks));
        // line 161
        echo "\">
                    ";
        // line 162
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["optionsForm"] ?? null), "custom_fields", []));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 163
            echo "                      <li>
                        ";
            // line 164
            echo twig_include($this->env, $context, "@Product/ProductPage/Forms/form_custom_fields.html.twig", ["form" => $context["field"]]);
            echo "
                      </li>
                    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 167
        echo "                  </ul>
                  <a href=\"#\" class=\"btn btn-outline-secondary add\">
                    <i class=\"material-icons\">add_circle</i>
                    ";
        // line 170
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Add a customization field", [], "Admin.Catalog.Feature"), "html", null, true);
        echo "
                  </a>
                </div>
              </div>
            </div>

            <div class=\"row mt-4\">
              <div class=\"col-md-8\">
                <h2>";
        // line 178
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Attached files", [], "Admin.Catalog.Feature"), "html", null, true);
        echo "</h2>
                <p class=\"subtitle\">";
        // line 179
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Select the files (instructions, documentation, recipes, etc.) your customers can directly download on this product page.", [], "Admin.Catalog.Feature"), "html", null, true);
        echo " <br/> ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Need to browse all files? Go to [1]Catalog > Files[/1]", ["[1]" => (("<a href=\"" . $this->env->getExtension('PrestaShopBundle\Twig\LayoutExtension')->getAdminLink("AdminAttachments")) . "\">"), "[/1]" => "</a>"], "Admin.Catalog.Feature");
        echo " </p>
                ";
        // line 180
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "attachments", []), 'widget');
        echo "
              </div>
            </div>
            <div class=\"row mt-3\">
              <div class=\"col-md-8\">
                <a
                  class=\"btn btn-outline-secondary mb-3\"
                  href=\"#collapsedForm\"
                  data-toggle=\"collapse\"
                  aria-expanded=\"false\"
                  aria-controls=\"collapsedForm\"
                >
                  <i class=\"material-icons\">add_circle</i>
                  ";
        // line 193
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Attach a new file", [], "Admin.Catalog.Feature"), "html", null, true);
        echo "
                </a>
                <fieldset class=\"form-group collapse\" id=\"collapsedForm\">
                  ";
        // line 196
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["optionsForm"] ?? null), "attachment_product", []), 'errors');
        echo "
                  <div id=\"form_step6_attachment_product\" data-action=\"";
        // line 197
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "attachment_product", []), "vars", []), "attr", []), "data-action", [], "array"), "html", null, true);
        echo "\">
                    <div class=\"form-group\">";
        // line 198
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "attachment_product", []), "file", []), 'widget');
        echo "</div>
                    <div class=\"form-group\">";
        // line 199
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "attachment_product", []), "name", []), 'widget');
        echo "</div>
                    <div class=\"form-group\">";
        // line 200
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "attachment_product", []), "description", []), 'widget');
        echo "</div>
                    <div class=\"form-group\">
                      ";
        // line 202
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "attachment_product", []), "add", []), 'widget');
        echo "
                      ";
        // line 203
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "attachment_product", []), "cancel", []), 'widget');
        echo "
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>

            <div class=\"row mt-3\">
              <div class=\"col-md-8\" id=\"supplier_collection\">
                ";
        // line 212
        echo twig_include($this->env, $context, "@Product/ProductPage/Forms/form_supplier_choice.html.twig", ["form" => ($context["optionsForm"] ?? null)]);
        echo "
              </div>
            </div>
            <div class=\"row\">
              <div id=\"supplier_combination_collection\" class=\"col-md-12\" data-url=\"";
        // line 216
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("admin_supplier_refresh_product_supplier_combination_form", ["idProduct" => ($context["productId"] ?? null), "supplierIds" => 1]), "html", null, true);
        echo "\">
                ";
        // line 217
        echo twig_include($this->env, $context, "@Product/ProductPage/Forms/form_supplier_combination.html.twig", ["suppliers" => $this->getAttribute($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "suppliers", []), "vars", []), "value", []), "form" => ($context["optionsForm"] ?? null)]);
        echo "
              </div>
            </div>

            ";
        // line 221
        echo $this->env->getExtension('PrestaShopBundle\Twig\HookExtension')->renderHook("displayAdminProductsOptionsStepBottom", ["id_product" => ($context["productId"] ?? null)]);
        echo "

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
";
    }

    // line 159
    public function block___internal_ee9237ed8c9ac932d270da9a19e842456b27f3845e3d80121d39ccee5928e9a0($context, array $blocks = [])
    {
        // line 160
        echo "                              ";
        echo twig_include($this->env, $context, "@Product/ProductPage/Forms/form_custom_fields.html.twig", ["form" => $this->getAttribute($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "custom_fields", []), "vars", []), "prototype", [])]);
        echo "
                              ";
    }

    public function getTemplateName()
    {
        return "@Product/ProductPage/Panels/options.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  447 => 160,  444 => 159,  431 => 221,  424 => 217,  420 => 216,  413 => 212,  401 => 203,  397 => 202,  392 => 200,  388 => 199,  384 => 198,  380 => 197,  376 => 196,  370 => 193,  354 => 180,  348 => 179,  344 => 178,  333 => 170,  328 => 167,  311 => 164,  308 => 163,  291 => 162,  288 => 161,  286 => 159,  281 => 157,  277 => 156,  273 => 155,  263 => 148,  259 => 147,  254 => 145,  249 => 143,  242 => 139,  238 => 138,  233 => 136,  228 => 134,  219 => 128,  215 => 127,  210 => 125,  205 => 123,  198 => 119,  194 => 118,  189 => 116,  184 => 114,  175 => 108,  168 => 104,  164 => 103,  159 => 101,  154 => 99,  144 => 92,  133 => 83,  131 => 78,  127 => 77,  121 => 74,  116 => 72,  110 => 69,  106 => 68,  102 => 67,  92 => 60,  86 => 57,  80 => 54,  74 => 51,  65 => 45,  61 => 44,  52 => 38,  48 => 37,  41 => 33,  31 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@Product/ProductPage/Panels/options.html.twig", "/home/codeoperativeco/public_html/src/PrestaShopBundle/Resources/views/Admin/Product/ProductPage/Panels/options.html.twig");
    }
}
