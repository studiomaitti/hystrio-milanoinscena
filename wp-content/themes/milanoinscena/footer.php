<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
</div><!-- #page -->
<div id="footer">
    <footer id="colophon" role="contentinfo" class="site">
        <div class="hystrio">
            <div>a cura di:</div>
            <div><a href="http://www.hystrio.it" title="Scopri Hystrio" target="_blank"><img src="<?php echo bloginfo('template_directory');?>/images/logo-hystrio-footer.png"/></a></div>
        </div><!-- .hystrio -->
        <div class="site-info">
© HYSTRIO - Associazione per la diffusione della Cultura Teatrale, Via Volturno 44, 20144 Milano - Direzione, redazione e pubblicità: via Olona 17, 20123 Milano<br/>
tel. 02/40073256 fax 02/45409483 - email: <a href="mailto:hystrio@fastwebnet.it" title="Invia un'email a hystrio@fastwebnet.it">hystrio@fastwebnet.it</a><br/>
Partita IVA 12213310159 
        </div><!-- .site-info -->
        <div class="progetto-di">
            <div class="progetto-di-t">Progetto di "Twister-Teatro in movimento"</div>
            <div><img src="<?php echo bloginfo('template_directory');?>/images/logo-twister-in-movimento.png"/></div>
        </div><!-- .hystrio -->
        <div class="finanziato-da">
            <div class="progetto-di-t">Finanziato da Fondazione Cariplo</div>
            <div><a href="http://www.fondazionecariplo.it" title="Vai al sito Fondazione Cariplo" target="_blank"><img src="<?php echo bloginfo('template_directory');?>/images/logo-fondazione-cariplo_r.png"/></a></div>
        </div><!-- .hystrio -->
    </footer><!-- #colophon -->
</div><!-- #footer -->

<?php wp_footer(); ?>
</body>
</html>