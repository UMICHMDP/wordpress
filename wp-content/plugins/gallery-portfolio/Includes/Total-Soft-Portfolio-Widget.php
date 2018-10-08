<?php
	class  Total_Soft_Portfolio extends WP_Widget
	{
		function __construct()
		{
			$params=array('name'=>'Total Soft Portfolio','description'=>'This is the widget of Total Soft Portfolio plugin');
			parent::__construct('Total_Soft_Portfolio','',$params);
		}
		function form($instance)
		{
			$defaults = array('Total_Soft_Portfolio'=>'');
			$instance = wp_parse_args((array)$instance, $defaults);

			$Portfolio = $instance['Total_Soft_Portfolio'];
			$instance['TS_Portfolio_Theme_Name'] = '';
			?>
			<div>
				<p>
					Portfolio Title:
					<select name="<?php echo $this->get_field_name('Total_Soft_Portfolio'); ?>" class="widefat">
						<?php
							global $wpdb;

							$table_name1 = $wpdb->prefix . "totalsoft_Portfolio";
							$Total_Soft_Portfolio = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id > %d", 0));

							foreach ($Total_Soft_Portfolio as $Total_Soft_Portfolio1)
							{
								?> <option value="<?php echo $Total_Soft_Portfolio1->id; ?>"> <?php echo $Total_Soft_Portfolio1->TotalSoftPortfolio_Name; ?> </option> <?php 
							}
						?>
					</select>
				</p>
			</div>
			<?php
		}
		function widget($args,$instance)
		{
			extract($args);
			$Total_Soft_Portfolio = empty($instance['Total_Soft_Portfolio']) ? '' : $instance['Total_Soft_Portfolio'];
			$Total_Soft_PortfolioT = empty($instance['TS_Portfolio_Theme_Name']) ? '' : $instance['TS_Portfolio_Theme_Name'];
			global $wpdb;

			$table_name2 = $wpdb->prefix . "totalsoft_portfolio_dbt";
			$table_name2_1 = $wpdb->prefix . "totalsoft_portfolio_dbt_1";
			$table_name2_2 = $wpdb->prefix . "totalsoft_portfolio_dbt_2";
			$table_name2_3 = $wpdb->prefix . "totalsoft_portfolio_dbt_3";
			$table_name2_4 = $wpdb->prefix . "totalsoft_portfolio_dbt_4";
			$table_name4 = $wpdb->prefix . "totalsoft_portfolio_manager";
			$table_name5 = $wpdb->prefix . "totalsoft_portfolio_albums";
			$table_name6 = $wpdb->prefix . "totalsoft_portfolio_images";

			$TotalSoftPortfolioManager = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id = %d", $Total_Soft_Portfolio));
			if($Total_Soft_PortfolioT == '')
			{
				$Total_Soft_PortfolioTh = $TotalSoftPortfolioManager[0]->TotalSoftPortfolio_Option;
				$TotalSoftPortfolioOpt = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE TotalSoftPortfolio_SetName = %s", $Total_Soft_PortfolioTh));

				$TotalSoftPortfolioOpt1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2_1 WHERE TotalSoftPortfolio_SetID = %s", $TotalSoftPortfolioOpt[0]->id));
				$TotalSoftPortfolioOpt2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2_2 WHERE TotalSoftPortfolio_SetID = %s", $TotalSoftPortfolioOpt[0]->id));
			}
			else if($Total_Soft_PortfolioT == 'true')
			{
				$TotalSoftPortfolioOpt = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2_3 WHERE id > %d", 0));

				$TotalSoftPortfolioOpt1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2_3 WHERE id > %d", 0));
				$TotalSoftPortfolioOpt2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2_4 WHERE id > %d", 0));
			}
			else
			{
				$Total_Soft_PortfolioTh = $Total_Soft_PortfolioT;
				$TotalSoftPortfolioOpt = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE TotalSoftPortfolio_SetName = %s", $Total_Soft_PortfolioTh));

				$TotalSoftPortfolioOpt1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2_1 WHERE TotalSoftPortfolio_SetID = %s", $TotalSoftPortfolioOpt[0]->id));
				$TotalSoftPortfolioOpt2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2_2 WHERE TotalSoftPortfolio_SetID = %s", $TotalSoftPortfolioOpt[0]->id));
			}

			$TotalSoftPortfolioAlbums = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name5 WHERE Portfolio_ID = %d order by id", $Total_Soft_Portfolio));
			$TotalSoftPortfolioImages = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE Portfolio_ID = %d order by id", $Total_Soft_Portfolio));

			if($TotalSoftPortfolioOpt[0]->TotalSoftPortfolio_SetType == 'Filterable Grid')
			{
				if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24 == '1')
				{
					$TotalSoft_FG_Slider_Icon_Left = 'totalsoft totalsoft-angle-double-left'; $TotalSoft_FG_Slider_Icon_Right = 'totalsoft totalsoft-angle-double-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24 == '2')
				{
					$TotalSoft_FG_Slider_Icon_Left = 'totalsoft totalsoft-angle-left'; $TotalSoft_FG_Slider_Icon_Right = 'totalsoft totalsoft-angle-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24 == '3')
				{
					$TotalSoft_FG_Slider_Icon_Left = 'totalsoft totalsoft-arrow-circle-left'; $TotalSoft_FG_Slider_Icon_Right ='totalsoft totalsoft-arrow-circle-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24 == '4')
				{
					$TotalSoft_FG_Slider_Icon_Left = 'totalsoft totalsoft-arrow-circle-o-left'; $TotalSoft_FG_Slider_Icon_Right = 'totalsoft totalsoft-arrow-circle-o-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24 == '5')
				{
					$TotalSoft_FG_Slider_Icon_Left = 'totalsoft totalsoft-arrow-left'; $TotalSoft_FG_Slider_Icon_Right = 'totalsoft totalsoft-arrow-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24 == '6')
				{
					$TotalSoft_FG_Slider_Icon_Left = 'totalsoft totalsoft-caret-left'; $TotalSoft_FG_Slider_Icon_Right = 'totalsoft totalsoft-caret-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24 == '7')
				{
					$TotalSoft_FG_Slider_Icon_Left = 'totalsoft totalsoft-caret-square-o-left'; $TotalSoft_FG_Slider_Icon_Right = 'totalsoft totalsoft-caret-square-o-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24 == '8')
				{
					$TotalSoft_FG_Slider_Icon_Left = 'totalsoft totalsoft-chevron-circle-left'; $TotalSoft_FG_Slider_Icon_Right = 'totalsoft totalsoft-chevron-circle-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24 == '9')
				{
					$TotalSoft_FG_Slider_Icon_Left = 'totalsoft totalsoft-chevron-left'; $TotalSoft_FG_Slider_Icon_Right = 'totalsoft totalsoft-chevron-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24 == '10')
				{
					$TotalSoft_FG_Slider_Icon_Left = 'totalsoft totalsoft-hand-o-left'; $TotalSoft_FG_Slider_Icon_Right = 'totalsoft totalsoft-hand-o-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24 == '11')
				{
					$TotalSoft_FG_Slider_Icon_Left = 'totalsoft totalsoft-long-arrow-left'; $TotalSoft_FG_Slider_Icon_Right = 'totalsoft totalsoft-long-arrow-right';
				}
				if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_27 == '1') { $TotalSoft_FG_Slider_Del_Icon_Type = 'totalsoft totalsoft-times'; }
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_27 == '2') { $TotalSoft_FG_Slider_Del_Icon_Type = 'totalsoft totalsoft-times-circle-o'; }
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_27 == '3') { $TotalSoft_FG_Slider_Del_Icon_Type = 'totalsoft totalsoft-times-circle'; }
				if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34 == '1') { $Pop_Ic_Type = 'totalsoft totalsoft-file-image-o'; }
				else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34 == '2') { $Pop_Ic_Type = 'totalsoft totalsoft-eye'; }
				else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34 == '3') { $Pop_Ic_Type = 'totalsoft totalsoft-camera-retro'; }
				else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34 == '4') { $Pop_Ic_Type = 'totalsoft totalsoft-picture-o'; }
				else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34 == '5') { $Pop_Ic_Type = 'totalsoft totalsoft-search-plus'; }
				else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34 == '6') { $Pop_Ic_Type = 'totalsoft totalsoft-expand'; }
				else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34 == '7') { $Pop_Ic_Type = 'totalsoft totalsoft-gratipay'; }
				else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34 == '8') { $Pop_Ic_Type = 'totalsoft totalsoft-search'; }
				if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_31 == '1')
				{
					$TotalSoft_FG_Car_Slider_Icon_Left = 'totalsoft totalsoft-angle-double-left'; $TotalSoft_FG_Car_Slider_Icon_Right = 'totalsoft totalsoft-angle-double-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_31 == '2')
				{
					$TotalSoft_FG_Car_Slider_Icon_Left = 'totalsoft totalsoft-angle-left'; $TotalSoft_FG_Car_Slider_Icon_Right = 'totalsoft totalsoft-angle-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_31 == '3')
				{
					$TotalSoft_FG_Car_Slider_Icon_Left = 'totalsoft totalsoft-arrow-circle-left'; $TotalSoft_FG_Car_Slider_Icon_Right = 'totalsoft totalsoft-arrow-circle-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_31 == '4')
				{
					$TotalSoft_FG_Car_Slider_Icon_Left = 'totalsoft totalsoft-arrow-circle-o-left'; $TotalSoft_FG_Car_Slider_Icon_Right = 'totalsoft totalsoft-arrow-circle-o-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_31 == '5')
				{
					$TotalSoft_FG_Car_Slider_Icon_Left = 'totalsoft totalsoft-arrow-left'; $TotalSoft_FG_Car_Slider_Icon_Right = 'totalsoft totalsoft-arrow-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_31 == '6')
				{
					$TotalSoft_FG_Car_Slider_Icon_Left = 'totalsoft totalsoft-caret-left'; $TotalSoft_FG_Car_Slider_Icon_Right = 'totalsoft totalsoft-caret-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_31 == '7')
				{
					$TotalSoft_FG_Car_Slider_Icon_Left = 'totalsoft totalsoft-caret-square-o-left'; $TotalSoft_FG_Car_Slider_Icon_Right = 'totalsoft totalsoft-caret-square-o-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_31 == '8')
				{
					$TotalSoft_FG_Car_Slider_Icon_Left = 'totalsoft totalsoft-chevron-circle-left'; $TotalSoft_FG_Car_Slider_Icon_Right = 'totalsoft totalsoft-chevron-circle-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_31 == '9')
				{
					$TotalSoft_FG_Car_Slider_Icon_Left = 'totalsoft totalsoft-chevron-left'; $TotalSoft_FG_Car_Slider_Icon_Right = 'totalsoft totalsoft-chevron-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_31 == '10')
				{
					$TotalSoft_FG_Car_Slider_Icon_Left = 'totalsoft totalsoft-hand-o-left'; $TotalSoft_FG_Car_Slider_Icon_Right = 'totalsoft totalsoft-hand-o-right';
				}
				else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_31=='11')
				{
					$TotalSoft_FG_Car_Slider_Icon_Left = 'totalsoft totalsoft-long-arrow-left'; $TotalSoft_FG_Car_Slider_Icon_Right = 'totalsoft totalsoft-long-arrow-right';
				}
			}
			echo $before_widget;
			?>
			<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('../CSS/totalsoft.css',__FILE__);?>">
			<link href="https://fonts.googleapis.com/css?family=ABeeZee|Abel|Abhaya+Libre|Abril+Fatface|Aclonica|Acme|Actor|Adamina|Advent+Pro|Aguafina+Script|Akronim|Aladin|Aldrich|Alef|Alegreya|Alegreya+SC|Alegreya+Sans|Alegreya+Sans+SC|Alex+Brush|Alfa+Slab+One|Alice|Alike|Alike+Angular|Allan|Allerta|Allerta+Stencil|Allura|Almendra|Almendra+Display|Almendra+SC|Amarante|Amaranth|Amatic+SC|Amethysta|Amiko|Amiri|Amita|Anaheim|Andada|Andika|Angkor|Annie+Use+Your+Telescope|Anonymous+Pro|Antic|Antic+Didone|Antic+Slab|Anton|Arapey|Arbutus|Arbutus+Slab|Architects+Daughter|Archivo|Archivo+Black|Archivo+Narrow|Aref+Ruqaa|Arima+Madurai|Arimo|Arizonia|Armata|Arsenal|Artifika|Arvo|Arya|Asap|Asap+Condensed|Asar|Asset|Assistant|Astloch|Asul|Athiti|Atma|Atomic+Age|Aubrey|Audiowide|Autour+One|Average|Average+Sans|Averia+Gruesa+Libre|Averia+Libre|Averia+Sans+Libre|Averia+Serif+Libre|Bad+Script|Bahiana|Baloo|Baloo+Bhai|Baloo+Bhaijaan|Baloo+Bhaina|Baloo+Chettan|Baloo+Da|Baloo+Paaji|Baloo+Tamma|Baloo+Tammudu|Baloo+Thambi|Balthazar|Bangers|Barlow|Barlow+Condensed|Barlow+Semi+Condensed|Barrio|Basic|Battambang|Baumans|Bayon|Belgrano|Bellefair|Belleza|BenchNine|Bentham|Berkshire+Swash|Bevan|Bigelow+Rules|Bigshot+One|Bilbo|Bilbo+Swash+Caps|BioRhyme|BioRhyme+Expanded|Biryani|Bitter|Black+And+White+Picture|Black+Han+Sans|Black+Ops+One|Bokor|Bonbon|Boogaloo|Bowlby+One|Bowlby+One+SC|Brawler|Bree+Serif|Bubblegum+Sans|Bubbler+One|Buda:300|Buenard|Bungee|Bungee+Hairline|Bungee+Inline|Bungee+Outline|Bungee+Shade|Butcherman|Butterfly+Kids|Cabin|Cabin+Condensed|Cabin+Sketch|Caesar+Dressing|Cagliostro|Cairo|Calligraffitti|Cambay|Cambo|Candal|Cantarell|Cantata+One|Cantora+One|Capriola|Cardo|Carme|Carrois+Gothic|Carrois+Gothic+SC|Carter+One|Catamaran|Caudex|Caveat|Caveat+Brush|Cedarville+Cursive|Ceviche+One|Changa|Changa+One|Chango|Chathura|Chau+Philomene+One|Chela+One|Chelsea+Market|Chenla|Cherry+Cream+Soda|Cherry+Swash|Chewy|Chicle|Chivo|Chonburi|Cinzel|Cinzel+Decorative|Clicker+Script|Coda|Coda+Caption:800|Codystar|Coiny|Combo|Comfortaa|Coming+Soon|Concert+One|Condiment|Content|Contrail+One|Convergence|Cookie|Copse|Corben|Cormorant|Cormorant+Garamond|Cormorant+Infant|Cormorant+SC|Cormorant+Unicase|Cormorant+Upright|Courgette|Cousine|Coustard|Covered+By+Your+Grace|Crafty+Girls|Creepster|Crete+Round|Crimson+Text|Croissant+One|Crushed|Cuprum|Cute+Font|Cutive|Cutive+Mono|Damion|Dancing+Script|Dangrek|David+Libre|Dawning+of+a+New+Day|Days+One|Delius|Delius+Swash+Caps|Delius+Unicase|Della+Respira|Denk+One|Devonshire|Dhurjati|Didact+Gothic|Diplomata|Diplomata+SC|Do+Hyeon|Dokdo|Domine|Donegal+One|Doppio+One|Dorsa|Dosis|Dr+Sugiyama|Duru+Sans|Dynalight|EB+Garamond|Eagle+Lake|East+Sea+Dokdo|Eater|Economica|Eczar|El+Messiri|Electrolize|Elsie|Elsie+Swash+Caps|Emblema+One|Emilys+Candy|Encode+Sans|Encode+Sans+Condensed|Encode+Sans+Expanded|Encode+Sans+Semi+Condensed|Encode+Sans+Semi+Expanded|Engagement|Englebert|Enriqueta|Erica+One|Esteban|Euphoria+Script|Ewert|Exo|Expletus+Sans|Fanwood+Text|Farsan|Fascinate|Fascinate+Inline|Faster+One|Fasthand|Fauna+One|Faustina|Federant|Federo|Felipa|Fenix|Finger+Paint|Fira+Mono|Fira+Sans|Fira+Sans+Condensed|Fira+Sans+Extra+Condensed|Fjalla+One|Fjord+One|Flamenco|Flavors|Fondamento|Fontdiner+Swanky|Forum|Francois+One|Frank+Ruhl+Libre|Freckle+Face|Fredericka+the+Great|Fredoka+One|Freehand|Fresca|Frijole|Fruktur|Fugaz+One|GFS+Didot|GFS+Neohellenic|Gabriela|Gaegu|Gafata|Galada|Galdeano|Galindo|Gamja+Flower|Gentium+Basic|Gentium+Book+Basic|Geo|Geostar|Geostar+Fill|Germania+One|Gidugu|Gilda+Display|Give+You+Glory|Glass+Antiqua|Glegoo|Gloria+Hallelujah|Goblin+One|Gochi+Hand|Gorditas|Gothic+A1|Graduate|Grand+Hotel|Gravitas+One|Great+Vibes|Griffy|Gruppo|Gudea|Gugi|Gurajada|Habibi|Halant|Hammersmith+One|Hanalei|Hanalei+Fill|Handlee|Hanuman|Happy+Monkey|Harmattan|Headland+One|Heebo|Henny+Penny|Herr+Von+Muellerhoff|Hi+Melody|Hind|Holtwood+One+SC|Homemade+Apple|Homenaje|IBM+Plex+Mono|IBM+Plex+Sans|IBM+Plex+Sans+Condensed|IBM+Plex+Serif|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Iceberg|Iceland|Imprima|Inconsolata|Inder|Indie+Flower|Inika|Irish+Grover|Istok+Web|Italiana|Italianno|Itim|Jacques+Francois|Jacques+Francois+Shadow|Jaldi|Jim+Nightshade|Jockey+One|Jolly+Lodger|Jomhuria|Josefin+Sans|Josefin+Slab|Joti+One|Jua|Judson|Julee|Julius+Sans+One|Junge|Jura|Just+Another+Hand|Just+Me+Again+Down+Here|Kadwa|Kalam|Kameron|Kanit|Kantumruy|Karla|Karma|Katibeh|Kaushan+Script|Kavivanar|Kavoon|Kdam+Thmor|Keania+One|Kelly+Slab|Kenia|Khand|Khmer|Khula|Kirang+Haerang|Kite+One|Knewave|Kotta+One|Koulen|Kranky|Kreon|Kristi|Krona+One|Kumar+One|Kumar+One+Outline|Kurale|La+Belle+Aurore|Laila|Lakki+Reddy|Lalezar|Lancelot|Lateef|Lato|League+Script|Leckerli+One|Ledger|Lekton|Lemon|Lemonada|Libre+Baskerville|Libre+Franklin|Life+Savers|Lilita+One|Lily+Script+One|Limelight|Linden+Hill|Lobster|Lobster+Two|Londrina+Outline|Londrina+Shadow|Londrina+Sketch|Londrina+Solid|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Lovers+Quarrel|Luckiest+Guy|Lusitana|Lustria|Macondo|Macondo+Swash+Caps|Mada|Magra|Maiden+Orange|Maitree|Mako|Mallanna|Mandali|Manuale|Marcellus|Marcellus+SC|Marck+Script|Margarine|Marko+One|Marmelad|Martel|Martel+Sans|Marvel|Mate|Mate+SC|Maven+Pro|McLaren|Meddon|MedievalSharp|Medula+One|Meera+Inimai|Megrim|Meie+Script|Merienda|Merienda+One|Merriweather|Merriweather+Sans|Metal|Metal+Mania|Metamorphous|Metrophobic|Michroma|Milonga|Miltonian|Miltonian+Tattoo|Mina|Miniver|Miriam+Libre|Mirza|Miss+Fajardose|Mitr|Modak|Modern+Antiqua|Mogra|Molengo|Molle:400i|Monda|Monofett|Monoton|Monsieur+La+Doulaise|Montaga|Montez|Montserrat|Montserrat+Alternates|Montserrat+Subrayada|Moul|Moulpali|Mountains+of+Christmas|Mouse+Memoirs|Mr+Bedfort|Mr+Dafoe|Mr+De+Haviland|Mrs+Saint+Delafield|Mrs+Sheppards|Mukta|Muli|Mystery+Quest|NTR|Nanum+Brush+Script|Nanum+Gothic|Nanum+Gothic+Coding|Nanum+Myeongjo|Nanum+Pen+Script|Neucha|Neuton|New+Rocker|News+Cycle|Niconne|Nixie+One|Nobile|Nokora|Norican|Nosifer|Nothing+You+Could+Do|Noticia+Text|Noto+Sans|Noto+Serif|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Numans|Nunito|Nunito+Sans|Odor+Mean+Chey|Offside|Old+Standard+TT|Oldenburg|Oleo+Script|Oleo+Script+Swash+Caps|Open+Sans|Open+Sans+Condensed:300|Oranienbaum|Orbitron|Oregano|Orienta|Original+Surfer|Oswald|Over+the+Rainbow|Overlock|Overlock+SC|Overpass|Overpass+Mono|Ovo|Oxygen|Oxygen+Mono|PT+Mono|PT+Sans|PT+Sans+Caption|PT+Sans+Narrow|PT+Serif|PT+Serif+Caption|Pacifico|Padauk|Palanquin|Palanquin+Dark|Pangolin|Paprika|Parisienne|Passero+One|Passion+One|Pathway+Gothic+One|Patrick+Hand|Patrick+Hand+SC|Pattaya|Patua+One|Pavanam|Paytone+One|Peddana|Peralta|Permanent+Marker|Petit+Formal+Script|Petrona|Philosopher|Piedra|Pinyon+Script|Pirata+One|Plaster|Play|Playball|Playfair+Display|Playfair+Display+SC|Podkova|Poiret+One|Poller+One|Poly|Pompiere|Pontano+Sans|Poor+Story|Poppins|Port+Lligat+Sans|Port+Lligat+Slab|Pragati+Narrow|Prata|Preahvihear|Pridi|Princess+Sofia|Prociono|Prompt|Prosto+One|Proza+Libre|Puritan|Purple+Purse|Quando|Quantico|Quattrocento|Quattrocento+Sans|Questrial|Quicksand|Quintessential|Qwigley|Racing+Sans+One|Radley|Rajdhani|Rakkas|Raleway|Raleway+Dots|Ramabhadra|Ramaraja|Rambla|Rammetto+One|Ranchers|Rancho|Ranga|Rasa|Rationale|Ravi+Prakash|Redressed|Reem+Kufi|Reenie+Beanie|Revalia|Rhodium+Libre|Ribeye|Ribeye+Marrow|Righteous|Risque|Roboto|Roboto+Condensed|Roboto+Mono|Roboto+Slab|Rochester|Rock+Salt|Rokkitt|Romanesco|Ropa+Sans|Rosario|Rosarivo|Rouge+Script|Rozha+One|Rubik|Rubik+Mono+One|Ruda|Rufina|Ruge+Boogie|Ruluko|Rum+Raisin|Ruslan+Display|Russo+One|Ruthie|Rye|Sacramento|Sahitya|Sail|Saira|Saira+Condensed|Saira+Extra+Condensed|Saira+Semi+Condensed|Salsa|Sanchez|Sancreek|Sansita|Sarala|Sarina|Sarpanch|Satisfy|Scada|Scheherazade|Schoolbell|Scope+One|Seaweed+Script|Secular+One|Sedgwick+Ave|Sedgwick+Ave+Display|Sevillana|Seymour+One|Shadows+Into+Light|Shadows+Into+Light+Two|Shanti|Share|Share+Tech|Share+Tech+Mono|Shojumaru|Short+Stack|Shrikhand|Siemreap|Sigmar+One|Signika|Signika+Negative|Simonetta|Sintony|Sirin+Stencil|Six+Caps|Skranji|Slackey|Smokum|Smythe|Sniglet|Snippet|Snowburst+One|Sofadi+One|Sofia|Song+Myung|Sonsie+One|Sorts+Mill+Goudy|Source+Code+Pro|Source+Sans+Pro|Source+Serif+Pro|Space+Mono|Special+Elite|Spectral|Spectral+SC|Spicy+Rice|Spinnaker|Spirax|Squada+One|Sree+Krushnadevaraya|Sriracha|Stalemate|Stalinist+One|Stardos+Stencil|Stint+Ultra+Condensed|Stint+Ultra+Expanded|Stoke|Strait|Stylish|Sue+Ellen+Francisco|Suez+One|Sumana|Sunflower:300|Sunshiney|Supermercado+One|Sura|Suranna|Suravaram|Suwannaphum|Swanky+and+Moo+Moo|Syncopate|Tajawal|Tangerine|Taprom|Tauri|Taviraj|Teko|Telex|Tenali+Ramakrishna|Tenor+Sans|Text+Me+One|The+Girl+Next+Door|Tienne|Tillana|Timmana|Tinos|Titan+One|Titillium+Web|Trade+Winds|Trirong|Trocchi|Trochut|Trykker|Tulpen+One|Ubuntu|Ubuntu+Condensed|Ubuntu+Mono|Ultra|Uncial+Antiqua|Underdog|Unica+One|UnifrakturCook:700|UnifrakturMaguntia|Unkempt|Unlock|Unna|VT323|Vampiro+One|Varela|Varela+Round|Vast+Shadow|Vesper+Libre|Vibur|Vidaloka|Viga|Voces|Volkhov|Vollkorn|Vollkorn+SC|Voltaire|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Warnes|Wellfleet|Wendy+One|Wire+One|Work+Sans|Yanone+Kaffeesatz|Yantramanav|Yatra+One|Yellowtail|Yeon+Sung|Yeseva+One|Yesteryear|Yrsa|Zeyada|Zilla+Slab|Zilla+Slab+Highlight" rel="stylesheet">
			<?php if($TotalSoftPortfolioOpt[0]->TotalSoftPortfolio_SetType == 'Total Soft Portfolio'){ ?>
				<style type="text/css">
					.portfolio_<?php echo $Total_Soft_Portfolio;?> { height:0px; }
					.background_<?php echo $Total_Soft_Portfolio;?>
					{
						background:url(<?php echo plugins_url('../Images/' . $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02,__FILE__);?>) no-repeat center;
					}
					.portfolio_<?php echo $Total_Soft_Portfolio;?> .item div img 
					{
						width:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?>px;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>px;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?>;
						border-radius:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>%;
					}
					.portfolio_<?php echo $Total_Soft_Portfolio;?> .item 
					{
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>px;
					}
					.portfolio_<?php echo $Total_Soft_Portfolio;?> .paths a 
					{
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>px;
					}
					.portfolio_<?php echo $Total_Soft_Portfolio;?> .paths a:hover
					{
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
					}
					.portfolio_<?php echo $Total_Soft_Portfolio;?> .paths .active
					{
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12;?>;
					}
					.Total_Soft_Portfolio_Icon_<?php echo $Total_Soft_Portfolio;?>
					{
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?>px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>;
					}
					.Total_Soft_Portfolio_Icon_<?php echo $Total_Soft_Portfolio;?>:hover { opacity:0.8; }
					.gallery<?php echo $Total_Soft_Portfolio;?> { margin-left:0px !important; margin-right:0px !important; }
				</style>
				<div class="portfolio portfolio<?php echo $Total_Soft_Portfolio;?> portfolio_<?php echo $Total_Soft_Portfolio;?>">
					<input type="text" style="display:none;" class="TotalSoftPortfolio_IW<?php echo $Total_Soft_Portfolio;?>" value="<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?>">
					<input type="text" style="display:none;" class="TotalSoftPortfolio_IH<?php echo $Total_Soft_Portfolio;?>" value="<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>">
					<input type="text" style="display:none;" class="TotalSoftPortfolio_NavS<?php echo $Total_Soft_Portfolio;?>" value="<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?>">
					<input type="text" style="display:none;" class="portDivHeigt<?php echo $Total_Soft_Portfolio;?>" value="<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01;?>">
					<input type="text" style="display:none;" class="portItemHeigt<?php echo $Total_Soft_Portfolio;?>" value="<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04+100;?>">
					<input type="text" style="display:none;" class="portImHeigt<?php echo $Total_Soft_Portfolio;?>" value="<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>">
					<input type="text" style="display:none;" class="portImWidth<?php echo $Total_Soft_Portfolio;?>" value="<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?>">
					<input type="text" style="display:none;" class="TSICWidth<?php echo $Total_Soft_Portfolio;?>" value="<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?>">
					<div class="background background_<?php echo $Total_Soft_Portfolio;?>"></div>
					<div class="arrows">
						<span class="up up<?php echo $Total_Soft_Portfolio;?>" style='text-align:center;'><i class="TSIC Total_Soft_Portfolio_Icon_<?php echo $Total_Soft_Portfolio;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>"></i></span>
						<span class="down down<?php echo $Total_Soft_Portfolio;?>" style='text-align:center;'><i class="TSIC Total_Soft_Portfolio_Icon_<?php echo $Total_Soft_Portfolio;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>"></i></span>
						<span class="prev prev<?php echo $Total_Soft_Portfolio;?> portIcLeft"><i class="TSIC Total_Soft_Portfolio_Icon_<?php echo $Total_Soft_Portfolio;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>"></i></span>
						<span class="next next<?php echo $Total_Soft_Portfolio;?> portIcRight" style='text-align:right;'><i class="TSIC Total_Soft_Portfolio_Icon_<?php echo $Total_Soft_Portfolio;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>"></i></spana>
					</div>
					<div class="gallery gallery<?php echo $Total_Soft_Portfolio;?>">
						<div class="inside">
							<?php for($i=0;$i<$TotalSoftPortfolioManager[0]->TotalSoftPortfolio_AlbumCount;$i++){
									$TSoftPort_ElGrid_Images=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE TotalSoftPortfolio_IA = %s and Portfolio_ID = %s order by id", $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle, $Total_Soft_Portfolio));
								?>
								<div class="item">
									<?php for($j=0;$j<count($TSoftPort_ElGrid_Images);$j++){ ?>
										<div><img src="<?php echo $TSoftPort_ElGrid_Images[$j]->TotalSoftPortfolio_IURL;?>" alt="<?php echo $TSoftPort_ElGrid_Images[$j]->TotalSoftPortfolio_IURL;?>" /></div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					(function($){
						jQuery(document).ready(function(){
							var portDivHeigt<?php echo $Total_Soft_Portfolio;?> = parseInt(jQuery('.portDivHeigt<?php echo $Total_Soft_Portfolio;?>').val());
							var portItemHeigt<?php echo $Total_Soft_Portfolio;?> = parseInt(jQuery('.portItemHeigt<?php echo $Total_Soft_Portfolio;?>').val());
							var portfolioparentwidth<?php echo $Total_Soft_Portfolio;?> = jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?>').parent().width();
							if(!portfolioparentwidth<?php echo $Total_Soft_Portfolio;?>) { setTimeout(function(){ resp<?php echo $Total_Soft_Portfolio;?>(); },500)	}
							var portImHeigt<?php echo $Total_Soft_Portfolio;?> = parseInt(jQuery('.portImHeigt<?php echo $Total_Soft_Portfolio;?>').val());
							var portImWidth<?php echo $Total_Soft_Portfolio;?> = parseInt(jQuery('.portImWidth<?php echo $Total_Soft_Portfolio;?>').val());
							var TSICWidth<?php echo $Total_Soft_Portfolio;?> = parseInt(jQuery('.TSICWidth<?php echo $Total_Soft_Portfolio;?>').val());
							function resp<?php echo $Total_Soft_Portfolio;?>()
							{
								jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?> .item').css('height',Math.ceil(portItemHeigt<?php echo $Total_Soft_Portfolio;?>*2/3*jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?>').parent().width()/1000));
								jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?> .item div img').css('width',Math.ceil(portImWidth<?php echo $Total_Soft_Portfolio;?>*2/3*jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?>').parent().width()/1000));
								jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?> .item div img').css('height',Math.ceil(portImHeigt<?php echo $Total_Soft_Portfolio;?>*2/3*jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?>').parent().width()/1000));
								jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?>').css('height',Math.ceil(portDivHeigt<?php echo $Total_Soft_Portfolio;?>*2/3*jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?>').parent().width()/1000));
								jQuery('.TSIC').css('font-size',Math.ceil(TSICWidth<?php echo $Total_Soft_Portfolio;?>*jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?>').parent().width()/1000));
								jQuery('.portIcLeft').css('left',Math.ceil(60*jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?>').parent().width()/1000));
								jQuery('.portIcRight').css('right',Math.ceil(60*jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?>').parent().width()/1000));
							}
							resp<?php echo $Total_Soft_Portfolio;?>();
							jQuery(window).resize(function(){ resp<?php echo $Total_Soft_Portfolio;?>(); })
						})
						$.fn.portfolio<?php echo $Total_Soft_Portfolio;?> = function(options) {
							var TotalSoftPortfolio_IW<?php echo $Total_Soft_Portfolio;?>=parseInt(jQuery('.TotalSoftPortfolio_IW<?php echo $Total_Soft_Portfolio;?>').val());
							var TotalSoftPortfolio_IH<?php echo $Total_Soft_Portfolio;?>=parseInt(jQuery('.TotalSoftPortfolio_IH<?php echo $Total_Soft_Portfolio;?>').val());
							var TotalSoftPortfolio_NavS<?php echo $Total_Soft_Portfolio;?>=parseInt(jQuery('.TotalSoftPortfolio_NavS<?php echo $Total_Soft_Portfolio;?>').val());
							var portfolioparentwidth<?php echo $Total_Soft_Portfolio;?> = jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?>').parent().width();
							if(!portfolioparentwidth<?php echo $Total_Soft_Portfolio;?>) { portfolioparentwidth<?php echo $Total_Soft_Portfolio;?> = 800; }
							var d = {
								image: {
									width: TotalSoftPortfolio_IW<?php echo $Total_Soft_Portfolio;?>,
									height: TotalSoftPortfolio_IH<?php echo $Total_Soft_Portfolio;?>,
									margin: 0
								},
								path: {
									width: Math.ceil(TotalSoftPortfolio_NavS<?php echo $Total_Soft_Portfolio;?>*portfolioparentwidth<?php echo $Total_Soft_Portfolio;?>/1000),
									height: Math.ceil(TotalSoftPortfolio_NavS<?php echo $Total_Soft_Portfolio;?>*portfolioparentwidth<?php echo $Total_Soft_Portfolio;?>/1000),
									marginTop: Math.ceil(5*portfolioparentwidth<?php echo $Total_Soft_Portfolio;?>/1000),
									marginLeft: Math.ceil(5*portfolioparentwidth<?php echo $Total_Soft_Portfolio;?>/1000)
								},
								animationSpeed: 400
							}; // default settings
							var s = $.extend({}, d, options);
							return this.each(function(){
								var $t = $(this),
									plugin = {
										init: function(){
											this.set.position();
											this.position.check(0, 0);
											this.paths.draw();
											this.paths.go();
											this.animate.item();
										},
										set: {
											position: function(){
												$t.find('.item').each(function(i){
													var t = $(this);
													t.css({ left: (s.image.width+s.image.margin)*i+'px' });
													t.find('div').each(function(j){
														var t = $(this);
														t.css({ top: (s.image.height+s.image.margin)*j+'px' });
													});
												});
											}
										},
										paths: {
											draw: function(){
												$t.append($('<div />').addClass('paths'));
												var path = $t.find('.paths'),
													items = $t.find('.item');
												items.each(function(i){
													var t = $(this), div = t.find('div');
													path.append($('<div />').addClass('path'+i).css({
															width: s.path.width+'px', 
															left: (s.path.width+s.path.marginLeft)*i+'px' 
														})
													);
													div.each(function(j){
														$('<a />').attr({ href: '#', rel: j }).css({ 
															width: s.path.width+'px',
															height: s.path.height+'px',
															top: (s.path.height+s.path.marginTop)*j+'px'
														}).appendTo(path.find('.path'+i))
													});
												});
												path.find('.path0').find('a').eq(0).addClass('active');
											},
											go: function(){
												$t.find('.paths').find('a').click(function(){
													var t = $(this), all = $t.find('.paths').find('a'), column = t.parent('div').attr('class').split('path')[1], row = t.attr('rel'), 
														inside = $t.find('.inside'),
														top = row*(s.image.height+s.image.margin),
														left = column*(s.image.width+s.image.margin);
													inside.animate({
														top: -top+'px',
														left: -left+'px'
													}, s.animationSpeed, function(){
														plugin.position.get(inside);
													});
													return false;
												});
											},
											classes: function(column, row){
												var anchors = $t.find('.paths').find('a'), anchor = anchors.filter(function(){
													var t = $(this),
														col = t.parent('div').attr('class').split('path')[1], 
														r = t.attr('rel');
													return col == column && r == row;
												});
												anchors.removeClass('active');
												anchor.addClass('active');
											}
										},
										animate: {
											item: function(){
												var down<?php echo $Total_Soft_Portfolio;?> = { top: '-='+(s.image.height+s.image.margin)+'px' },
													up<?php echo $Total_Soft_Portfolio;?> = { top: '+='+(s.image.height+s.image.margin)+'px' },
													next<?php echo $Total_Soft_Portfolio;?> = { top: 0, left: '-='+(s.image.width+s.image.margin)+'px' },
													prev<?php echo $Total_Soft_Portfolio;?> = { top: 0, left: '+='+(s.image.width+s.image.margin)+'px' }
												plugin.animate.img('.down<?php echo $Total_Soft_Portfolio;?>', down<?php echo $Total_Soft_Portfolio;?>, 40);
												plugin.animate.img('.up<?php echo $Total_Soft_Portfolio;?>', up<?php echo $Total_Soft_Portfolio;?>, 38);
												plugin.animate.img('.next<?php echo $Total_Soft_Portfolio;?>', next<?php echo $Total_Soft_Portfolio;?>, 39);
												plugin.animate.img('.prev<?php echo $Total_Soft_Portfolio;?>', prev<?php echo $Total_Soft_Portfolio;?>, 37);
											},
											img: function(element, object, key){
												var inside = $t.find('.inside'), type = $.browser.mozilla ? 'keypress' : 'keydown';
												$(element).click(function(){
													var t = $(this);
													if (!t.hasClass('active')){
														inside.animate(object, s.animationSpeed, function(){
															plugin.position.get(inside);
															t.removeClass('active');
														});
													}
													t.addClass('active');
													return false;
												});
												$(document).bind(type, function(e) {
													var code = e.keyCode ? e.keyCode : e.which;
													if(code == key && $(element).is(':visible')) { 
														if (!inside.is(':animated')) {
															inside.animate(object, s.animationSpeed, function(){
																plugin.position.get(inside);
															});
														}
													}
													return false;
												});
											}
										},
										position: {
											get: function(element){
												var top = element.position().top,
													left = element.position().left;
												plugin.position.check(top, left);
											},
											check: function(top, left){
												top = ($.browser.msie && parseInt($.browser.version) == 8 && top != 0) ? top-1 : top;
												var items = $t.find('.item'),
													size_left = items.length-1,
													max_left = -size_left*(s.image.width+s.image.margin),
													column = left*size_left/max_left,
													current = items.filter(function(){
														return parseInt($(this).css('left')) == -left;
													}),
													size_top = current.find('div').length-1,
													max_top = -size_top*(s.image.height+s.image.margin),
													row = top*size_top/max_top,
													arrows = $t.find('.arrows'), 
													up<?php echo $Total_Soft_Portfolio;?> = arrows.find('.up<?php echo $Total_Soft_Portfolio;?>'), down<?php echo $Total_Soft_Portfolio;?> = arrows.find('.down<?php echo $Total_Soft_Portfolio;?>'),
													next<?php echo $Total_Soft_Portfolio;?> = arrows.find('.next<?php echo $Total_Soft_Portfolio;?>'), prev<?php echo $Total_Soft_Portfolio;?> = arrows.find('.prev<?php echo $Total_Soft_Portfolio;?>');
												if (left==max_left){ next<?php echo $Total_Soft_Portfolio;?>.hide(); } else { next<?php echo $Total_Soft_Portfolio;?>.show(); }
												if (left<0) { prev<?php echo $Total_Soft_Portfolio;?>.show(); } else { prev<?php echo $Total_Soft_Portfolio;?>.hide(); }
												if (top==max_top){ down<?php echo $Total_Soft_Portfolio;?>.hide(); } else { down<?php echo $Total_Soft_Portfolio;?>.show(); }
												if (top<0) { up<?php echo $Total_Soft_Portfolio;?>.show(); } else { up<?php echo $Total_Soft_Portfolio;?>.hide(); }
												if (top == 0 && size_top == 0 && max_top == 0) { row = 0; }
												plugin.paths.classes(column, row);
											}
										}
									}
								plugin.init();
							});
						};
					}(jQuery));
				</script>
				<script type="text/javascript">
					var o<?php echo $Total_Soft_Portfolio;?> = {
						init: function(){
							this.portfolio<?php echo $Total_Soft_Portfolio;?>.init();
						},
						portfolio<?php echo $Total_Soft_Portfolio;?>: {
							data: {
							},
							init: function(){
								jQuery('.portfolio_<?php echo $Total_Soft_Portfolio;?>').portfolio<?php echo $Total_Soft_Portfolio;?>(o<?php echo $Total_Soft_Portfolio;?>.portfolio<?php echo $Total_Soft_Portfolio;?>.data);
							}
						}
					}
					jQuery(function(){ o<?php echo $Total_Soft_Portfolio;?>.init(); });
				</script>
			<?php } else if($TotalSoftPortfolioOpt[0]->TotalSoftPortfolio_SetType == 'Elastic Grid'){ ?>
				<style type="text/css">
					.wagwep-container<?php echo $Total_Soft_Portfolio; ?>
					{
						display: <?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02=='false'){echo 'none';}?>
					}
					nav.porfolio-nav<?php echo $Total_Soft_Portfolio; ?>
					{
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?>;
					}
					ul.portfolio-filter<?php echo $Total_Soft_Portfolio; ?> a:hover
					{
						text-decoration: none;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> !important;
					}
					.wagwep-container<?php echo $Total_Soft_Portfolio; ?> ul.portfolio-filter<?php echo $Total_Soft_Portfolio; ?> li.current a
					{
						background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>;
					}
					.wagwep-container<?php echo $Total_Soft_Portfolio; ?> ul.portfolio-filter<?php echo $Total_Soft_Portfolio; ?> a
					{
						background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12;?>;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?>px;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>;
						line-height: 1 !important;
						display: initial !important;
					}
					.wagwep-container<?php echo $Total_Soft_Portfolio; ?> ul.portfolio-filter<?php echo $Total_Soft_Portfolio; ?> li
					{
						line-height: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?>px;
					}
					.wagwep-container<?php echo $Total_Soft_Portfolio; ?> ul.portfolio-filter<?php echo $Total_Soft_Portfolio; ?>
					{
						border-bottom: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?> { list-style: none; padding: 20px 0 !important; margin: 0 auto !important; text-align: center; width: 100%; }
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li { display: inline-block; margin: 10px 5px 0 5px !important; vertical-align: top; padding: 0 !important; position: static !important; }
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li.hidden { display: none; }
					.og-grid<?php echo $Total_Soft_Portfolio;?> li > a, .og-grid<?php echo $Total_Soft_Portfolio;?> li > a img { border: none; outline: none; display: block; position: relative; }
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li a:hover, .og-grid<?php echo $Total_Soft_Portfolio; ?> li a:focus { border-bottom: none !important; }
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li a { overflow: hidden; }
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li a.unhoverdir { overflow: visible; }
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li a figure { position: absolute; width: 100%; height: 100%; }
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li a figure span { display: block; padding: 10px 0; margin: 40px 20px 20px 20px; font-weight: normal; }
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-opacity li.animate
					{
						-webkit-animation: fadeIn 0.65s ease forwards;
						-moz-animation: fadeIn 0.65s ease forwards;
						animation: fadeIn 0.65s ease forwards;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-moveup li.animate
					{
						-webkit-transform: translateY(200px);
						-moz-transform: translateY(200px);
						transform: translateY(200px);
						-webkit-animation: moveUp 0.65s ease forwards;
						-moz-animation: moveUp 0.65s ease forwards;
						animation: moveUp 0.65s ease forwards;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-scaleup li.animate
					{
						-webkit-transform: scale(0.6);
						-moz-transform: scale(0.6);
						transform: scale(0.6);
						-webkit-animation: scaleUp 0.65s ease-in-out forwards;
						-moz-animation: scaleUp 0.65s ease-in-out forwards;
						animation: scaleUp 0.65s ease-in-out forwards;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-fallperspective
					{
						-webkit-perspective: 1300px;
						-moz-perspective: 1300px;
						perspective: 1300px;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-fallperspective li.animate
					{
						-webkit-transform-style: preserve-3d;
						-moz-transform-style: preserve-3d;
						transform-style: preserve-3d;
						-webkit-transform: translateZ(400px) translateY(300px) rotateX(-90deg);
						-moz-transform: translateZ(400px) translateY(300px) rotateX(-90deg);
						transform: translateZ(400px) translateY(300px) rotateX(-90deg);
						-webkit-animation: fallPerspective .8s ease-in-out forwards;
						-moz-animation: fallPerspective .8s ease-in-out forwards;
						animation: fallPerspective .8s ease-in-out forwards;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-fly
					{
						-webkit-perspective: 1300px;
						-moz-perspective: 1300px;
						perspective: 1300px;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-fly li.animate
					{
						-webkit-transform-style: preserve-3d;
						-moz-transform-style: preserve-3d;
						transform-style: preserve-3d;
						-webkit-transform-origin: 50% 50% -300px;
						-moz-transform-origin: 50% 50% -300px;
						transform-origin: 50% 50% -300px;
						-webkit-transform: rotateX(-180deg);
						-moz-transform: rotateX(-180deg);
						transform: rotateX(-180deg);
						-webkit-animation: fly .8s ease-in-out forwards;
						-moz-animation: fly .8s ease-in-out forwards;
						animation: fly .8s ease-in-out forwards;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-flip
					{
						-webkit-perspective: 1300px;
						-moz-perspective: 1300px;
						perspective: 1300px;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-flip li.animate
					{
						-webkit-transform-style: preserve-3d;
						-moz-transform-style: preserve-3d;
						transform-style: preserve-3d;
						-webkit-transform-origin: 0% 0%;
						-moz-transform-origin: 0% 0%;
						transform-origin: 0% 0%;
						-webkit-transform: rotateX(-80deg);
						-moz-transform: rotateX(-80deg);
						transform: rotateX(-80deg);
						-webkit-animation: flip .8s ease-in-out forwards;
						-moz-animation: flip .8s ease-in-out forwards;
						animation: flip .8s ease-in-out forwards;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-helix
					{
						-webkit-perspective: 1300px;
						-moz-perspective: 1300px;
						perspective: 1300px;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-helix li.animate
					{
						-webkit-transform-style: preserve-3d;
						-moz-transform-style: preserve-3d;
						transform-style: preserve-3d;
						-webkit-transform: rotateY(-180deg);
						-moz-transform: rotateY(-180deg);
						transform: rotateY(-180deg);
						-webkit-animation: helix .8s ease-in-out forwards;
						-moz-animation: helix .8s ease-in-out forwards;
						animation: helix .8s ease-in-out forwards;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-popup
					{
						-webkit-perspective: 1300px;
						-moz-perspective: 1300px;
						perspective: 1300px;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?>.effect-popup li.animate
					{
						-webkit-transform-style: preserve-3d;
						-moz-transform-style: preserve-3d;
						transform-style: preserve-3d;
						-webkit-transform: scale(0.4);
						-moz-transform: scale(0.4);
						transform: scale(0.4);
						-webkit-animation: popUp .8s ease-in forwards;
						-moz-animation: popUp .8s ease-in forwards;
						animation: popUp .8s ease-in forwards;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?> .sep { display: none;}
					.og-grid<?php echo $Total_Soft_Portfolio; ?> .sep { margin: 20px 10px; height: 80%}
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li { height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?>px; }
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li > a, .og-grid<?php echo $Total_Soft_Portfolio; ?> li > a img
					{
						width:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?>px;
						border-radius:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>px;
						-webkit-box-shadow:0px 0px 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>; 
						-moz-box-shadow:0px 0px 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>; 
						box-shadow:0px 0px 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>; 
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li a:hover, .og-grid<?php echo $Total_Soft_Portfolio; ?> li a:focus
					{
						-webkit-box-shadow:0px 0px 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>; 
						-moz-box-shadow:0px 0px 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>; 
						box-shadow:0px 0px 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>; 
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li a figure
					{
						background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						margin: 0;
					}
					.og-grid<?php echo $Total_Soft_Portfolio; ?> li a figure span
					{
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>px;
						font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
						border-bottom: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
					}
					.og-expander<?php echo $Total_Soft_Portfolio; ?>
					{
						background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
						overflow: auto;
						padding-bottom: 5px;
						max-height: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					/* Events List custom webkit scrollbar */
					.og-expander<?php echo $Total_Soft_Portfolio; ?>::-webkit-scrollbar {width: 9px;}
					/* Track */
					.og-expander<?php echo $Total_Soft_Portfolio; ?>::-webkit-scrollbar-track {background: none;}
					/* Handle */
					.og-expander<?php echo $Total_Soft_Portfolio; ?>::-webkit-scrollbar-thumb
					{
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>;
						border:1px solid #E9EBEC;
						border-radius: 10px;
					}
					.og-expander<?php echo $Total_Soft_Portfolio; ?>::-webkit-scrollbar-thumb:hover {background:#cecece;}
					.og-pointer<?php echo $Total_Soft_Portfolio; ?>
					{
						border-bottom-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
					}
					.og-details<?php echo $Total_Soft_Portfolio; ?> h3
					{
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34;?>px;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?> !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?> !important;
						cursor: default;
					}
					.og-details<?php echo $Total_Soft_Portfolio; ?> p:nth-child(2) { max-height:200px !important; overflow-x:hidden; }
					.og-details<?php echo $Total_Soft_Portfolio; ?> p:nth-child(2)::-webkit-scrollbar { width: 0.5em; }
					.og-details<?php echo $Total_Soft_Portfolio; ?> p:nth-child(2)::-webkit-scrollbar-track
					{
						-webkit-box-shadow: inset 0 0 6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32; ?>;
					}
					.og-details<?php echo $Total_Soft_Portfolio; ?> p:nth-child(2)::-webkit-scrollbar-thumb
					{
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33; ?>;
						outline: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33; ?>;
					}
					.og-details<?php echo $Total_Soft_Portfolio; ?> a.link-button
					{
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_38;?>px;
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>;
						-moz-border-radius: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?>px;
						-webkit-border-radius: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?>px;
						border-radius: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?>px;
						border: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?>px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?> !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39;?>;
					}
					.og-details<?php echo $Total_Soft_Portfolio; ?> a:hover
					{
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?> !important;
						background-color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>;
					}
					.og-details<?php echo $Total_Soft_Portfolio; ?> .infosep
					{
						border-bottom: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07;?>px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?> <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_09;?>;
					}
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-carousel ul li { min-width: 20px; margin: 0 5px !important; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-wrapper { position: relative; margin: 0 auto; min-height: 60px; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-wrapper.elastislide<?php echo $Total_Soft_Portfolio; ?>-loading
					{
						background-image: url(../Images/loading.gif);
						background-repeat: no-repeat;
						background-position: center center;
					}
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-horizontal nav { padding: 0 !important; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-horizontal { padding: 10px 40px; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-vertical { padding: 40px 10px; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-carousel { overflow: hidden; position: relative; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-carousel ul
					{
						position: relative;
						display: block;
						list-style-type: none;
						padding: 0 !important;
						margin: 0;
						-webkit-backface-visibility: hidden;
						-moz-backface-visibility: hidden;
						backface-visibility: hidden;
						-webkit-transform: translateX(0px);
						-moz-transform: translateX(0px);
						-ms-transform: translateX(0px);
						-o-transform: translateX(0px);
						transform: translateX(0px);
					}
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-horizontal ul { white-space: nowrap; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-carousel ul li
					{
						margin: 0;
						-webkit-backface-visibility: hidden;
						-moz-backface-visibility: hidden;
						backface-visibility: hidden;
					}
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-horizontal ul li { height: 100%; display: inline-block; width:100px !important; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-vertical ul li { display: block; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-carousel ul li a { display: inline-block; width: 100%; padding: 0px; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-carousel ul li a img { display: block; max-width: 100%; }
					/* Navigation Arrows */
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-wrapper nav span { position: absolute; border-radius: 50%; cursor: pointer; opacity: 0.8; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-wrapper nav span:hover { opacity: 1.0 }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-horizontal nav span { top: 50%; left: 10px; margin-top: -11px; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-horizontal nav span.elastislide<?php echo $Total_Soft_Portfolio; ?>-next { right: 10px; left: auto; }
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-list li a:hover, .elastislide<?php echo $Total_Soft_Portfolio; ?>-list li a:focus
					{
						box-shadow: none !important;
						-moz-box-shadow: none !important;
						-webkit-box-shadow: none !important;
					}
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-TS_Portfolio_GAA_
					{
						background-color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10;?>;
						box-shadow: inset 0 0 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_11;?>;
						-moz-box-shadow: inset 0 0 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_11;?>;
						-webkit-box-shadow: inset 0 0 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_11;?>;
					}
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-list li a img, .elastislide<?php echo $Total_Soft_Portfolio; ?>-list li a, .elastislide<?php echo $Total_Soft_Portfolio; ?>-list li, .elastislide<?php echo $Total_Soft_Portfolio; ?>-list
					{
						height: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_12;?>px;
						box-shadow:none;
						-webkit-box-shadow:none;
						-moz-box-shadow:none;
					}
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-carousel ul li a img
					{
						border: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_13;?>px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_14;?> <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_15;?>;
						border-radius: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_16;?>px;
						-webkit-box-sizing: border-box;
						-moz-box-sizing: border-box;
						box-sizing: border-box;
					}
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-carousel ul li a img.selected
					{
						border-color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_17;?>;
					}
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-horizontal nav span.totalsoft
					{
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_22;?>;
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_21;?>px;
					}
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-horizontal nav span.totalsoft.elastislide<?php echo $Total_Soft_Portfolio; ?>-next:before
					{
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '1'){ ?>
							content: '\f101';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '2'){ ?>
							content: '\f105';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '3'){ ?>
							content: '\f0a9';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '4'){ ?>
							content: '\f18e';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '5'){ ?>
							content: '\f061';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '6'){ ?>
							content: '\f0da';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '7'){ ?>
							content: '\f152';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '8'){ ?>
							content: '\f054';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '9'){ ?>
							content: '\f138';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '10'){ ?>
							content: '\f0a4';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '11'){ ?>
							content: '\f178';
						<?php }?>
					}
					.elastislide<?php echo $Total_Soft_Portfolio; ?>-horizontal nav span.totalsoft.elastislide<?php echo $Total_Soft_Portfolio; ?>-prev:before
					{
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '1'){ ?>
							content: '\f100';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '2'){ ?>
							content: '\f104';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '3'){ ?>
							content: '\f0a8';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '4'){ ?>
							content: '\f190';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '5'){ ?>
							content: '\f060';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '6'){ ?>
							content: '\f0d9';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '7'){ ?>
							content: '\f191';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '8'){ ?>
							content: '\f053';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '9'){ ?>
							content: '\f137';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '10'){ ?>
							content: '\f0a5';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18 == '11'){ ?>
							content: '\f177';
						<?php }?>
					}
					.og-close<?php echo $Total_Soft_Portfolio; ?>.totalsoft
					{
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_26;?>;
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_25;?>px;
						z-index: 999999999;
					}
					.og-close<?php echo $Total_Soft_Portfolio; ?>.totalsoft:before
					{
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_23 == '1'){ ?>
							content: '\f057';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_23 == '2'){ ?>
							content: '\f05c';
						<?php }else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_23 == '3'){ ?>
							content: '\f00d';
						<?php }?>
					}
					@media only screen and (max-width : 480px) { .elastislide<?php echo $Total_Soft_Portfolio; ?>-wrapper { max-width: 300px; } }
					@media (max-width: 767px) 
					{
						.elastislide<?php echo $Total_Soft_Portfolio; ?>-horizontal ul li { width:100px !important; }
						.elastislide<?php echo $Total_Soft_Portfolio; ?>-wrapper { max-width: 300px; padding-bottom: 5px; }
					}
				</style>
				<div id="elastic_grid_demo<?php echo $Total_Soft_Portfolio; ?>"></div>
				<script src="<?php echo plugins_url('../JS/modernizr.custom.js',__FILE__);?>" type="text/javascript"></script>
				<script src="<?php echo plugins_url('../JS/classie.js',__FILE__);?>" type="text/javascript"></script>
				<script type="text/javascript">
					(function(g,h,e){var a=g.event,b,j;b=a.special.debouncedresize={setup:function(){g(this).on("resize",b.handler)},teardown:function(){g(this).off("resize",b.handler)},handler:function(o,k){var n=this,m=arguments,l=function(){o.type="debouncedresize";a.dispatch.apply(n,m)};if(j){clearTimeout(j)}k?l():j=setTimeout(l,b.threshold)},threshold:150};var c="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";g.fn.imagesLoaded=function(r){var o=this,t=g.isFunction(g.Deferred)?g.Deferred():0,s=g.isFunction(t.notify),l=o.find("img").add(o.filter("img")),m=[],q=[],n=[];if(g.isPlainObject(r)){g.each(r,function(u,v){if(u==="callback"){r=v}else{if(t){t[u](v)}}})}function p(){var u=g(q),v=g(n);if(t){if(n.length){t.reject(l,u,v)}else{t.resolve(l)}}if(g.isFunction(r)){r.call(o,l,u,v)}}function k(u,v){if(u.src===c||g.inArray(u,m)!==-1){return}m.push(u);if(v){n.push(u)}else{q.push(u)}g.data(u,"imagesLoaded",{isBroken:v,src:u.src});if(s){t.notifyWith(g(u),[v,l,g(q),g(n)])}if(l.length===m.length){setTimeout(p);l.unbind(".imagesLoaded")}}if(!l.length){p()}else{l.bind("load.imagesLoaded error.imagesLoaded",function(u){k(u.target,u.type==="error")}).each(function(u,w){var x=w.src;var v=g.data(w,"imagesLoaded");if(v&&v.src===x){k(w,v.isBroken);return}if(w.complete&&w.naturalWidth!==e){k(w,w.naturalWidth===0||w.naturalHeight===0);return}if(w.readyState||w.complete){w.src=c;w.src=x}})}return t?t.promise(o):o};var d=g(h),f=h.Modernizr;g.Elastislide<?php echo $Total_Soft_Portfolio; ?>=function(k,l){this.$el=g(l); this._init(k)};g.Elastislide<?php echo $Total_Soft_Portfolio; ?>.defaults={orientation:"horizontal",speed:500,easing:"ease-in-out",minItems:3,start:0,onClick:function(m,k,l){return false},onReady:function(){return false},onBeforeSlide:function(){return false},onAfterSlide:function(){return false}};g.Elastislide<?php echo $Total_Soft_Portfolio; ?>.prototype={_init:function(l){this.options=g.extend(true,{},g.Elastislide<?php echo $Total_Soft_Portfolio; ?>.defaults,l);var k=this,m={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd",msTransition:"MSTransitionEnd",transition:"transitionend"};this.transEndEventName=m[f.prefixed("transition")];this.support=f.csstransitions&&f.csstransforms;this.current=this.options.start;this.isSliding=false;this.$items=this.$el.children("li");this.itemsCount=this.$items.length;if(this.itemsCount===0){return false}this._validate();this.$items.detach();this.$el.empty();this.$el.append(this.$items);this.$el.wrap('<div class="elastislide<?php echo $Total_Soft_Portfolio; ?>-wrapper elastislide<?php echo $Total_Soft_Portfolio; ?>-loading elastislide<?php echo $Total_Soft_Portfolio; ?>-'+this.options.orientation+'"></div>');this.hasTransition=false;this.hasTransitionTimeout=setTimeout(function(){k._addTransition()},100);this.$el.imagesLoaded(function(){k.$el.show();k._layout();k._configure();if(k.hasTransition){k._removeTransition();k._slideToItem(k.current);k.$el.on(k.transEndEventName,function(){k.$el.off(k.transEndEventName);k._setWrapperSize();k._addTransition();k._initEvents()})}else{clearTimeout(k.hasTransitionTimeout);k._setWrapperSize();k._initEvents();k._slideToItem(k.current);setTimeout(function(){k._addTransition()},25)}k.options.onReady()})},_validate:function(){if(this.options.speed<0){this.options.speed=500}if(this.options.minItems<1||this.options.minItems>this.itemsCount){this.options.minItems=1}if(this.options.start<0||this.options.start>this.itemsCount-1){this.options.start=0}if(this.options.orientation!="horizontal"&&this.options.orientation!="vertical"){this.options.orientation="horizontal"}},_layout:function(){this.$el.wrap('<div class="elastislide<?php echo $Total_Soft_Portfolio; ?>-carousel"></div>');this.$carousel=this.$el.parent();this.$wrapper=this.$carousel.parent().removeClass("elastislide<?php echo $Total_Soft_Portfolio; ?>-loading");var k=this.$items.find("img:first");this.imgSize={width:k.outerWidth(true),height:k.outerHeight(true)};this._setItemsSize(); this.options.orientation==="horizontal"?this.$el.css("max-height",this.imgSize.height):this.$el.css("height",this.options.minItems*this.imgSize.height); this._addControls()},_addTransition:function(){if(this.support){this.$el.css("transition","all "+this.options.speed+"ms "+this.options.easing)}this.hasTransition=true},_removeTransition:function(){if(this.support){this.$el.css("transition","all 0s")}this.hasTransition=false},_addControls:function(){var k=this;this.$navigation=g('<nav><span class="elastislide<?php echo $Total_Soft_Portfolio; ?>-prev totalsoft"></span><span class="elastislide<?php echo $Total_Soft_Portfolio; ?>-next totalsoft"></span></nav>').appendTo(this.$wrapper); this.$navPrev=this.$navigation.find("span.elastislide<?php echo $Total_Soft_Portfolio; ?>-prev").on("mousedown.elastislide<?php echo $Total_Soft_Portfolio; ?>",function(l){k._slide("prev");return false});this.$navNext=this.$navigation.find("span.elastislide<?php echo $Total_Soft_Portfolio; ?>-next").on("mousedown.elastislide<?php echo $Total_Soft_Portfolio; ?>",function(l){k._slide("next");return false})},_setItemsSize:function(){var k=this.options.orientation==="horizontal"?(Math.floor(this.$carousel.width()/this.options.minItems)*100)/this.$carousel.width():100;this.$items.css({width:k+"%","max-width":this.imgSize.width,"max-height":this.imgSize.height}); if(this.options.orientation==="vertical"){this.$wrapper.css("max-width",this.imgSize.width+parseInt(this.$wrapper.css("padding-left"))+parseInt(this.$wrapper.css("padding-right")))}},_setWrapperSize:function(){if(this.options.orientation==="vertical"){this.$wrapper.css({height:this.options.minItems*this.imgSize.height+parseInt(this.$wrapper.css("padding-top"))+parseInt(this.$wrapper.css("padding-bottom"))})}},_configure:function(){this.fitCount=this.options.orientation==="horizontal"?this.$carousel.width()<this.options.minItems*this.imgSize.width?this.options.minItems:Math.floor(this.$carousel.width()/this.imgSize.width):this.$carousel.height()<this.options.minItems*this.imgSize.height?this.options.minItems:Math.floor(this.$carousel.height()/this.imgSize.height)},_initEvents:function(){var k=this;d.on("debouncedresize.elastislide<?php echo $Total_Soft_Portfolio; ?>",function(){k._setItemsSize();k._configure();k._slideToItem(k.current)});this.$el.on(this.transEndEventName,function(){k._onEndTransition()});if(this.options.orientation==="horizontal"){this.$el.on({swipeleft:function(){k._slide("next")},swiperight:function(){k._slide("prev")}})}else{this.$el.on({swipeup:function(){k._slide("next")},swipedown:function(){k._slide("prev")}})}this.$el.on("click.elastislide<?php echo $Total_Soft_Portfolio; ?>","li",function(m){var l=g(this);k.options.onClick(l,l.index(),m)})},_destroy:function(k){this.$el.off(this.transEndEventName).off("swipeleft swiperight swipeup swipedown .elastislide<?php echo $Total_Soft_Portfolio; ?>");d.off(".elastislide<?php echo $Total_Soft_Portfolio; ?>");this.$el.css({"max-height":"none",transition:"none"}).unwrap(this.$carousel).unwrap(this.$wrapper);this.$items.css({width:"auto","max-width":"none","max-height":"none"});this.$navigation.remove();this.$wrapper.remove();if(k){k.call()}},_toggleControls:function(k,l){if(l){(k==="next")?this.$navNext.show():this.$navPrev.show()}else{(k==="next")?this.$navNext.hide():this.$navPrev.hide()}},_slide:function(l,n){if(this.isSliding){return false}this.options.onBeforeSlide();this.isSliding=true;var t=this,k=this.translation||0,q=this.options.orientation==="horizontal"?this.$items.outerWidth(true):this.$items.outerHeight(true),o=this.itemsCount*q,m=this.options.orientation==="horizontal"?this.$carousel.width():this.$carousel.height();if(n===e){var p=this.fitCount*q;if(p<0){return false}if(l==="next"&&o-(Math.abs(k)+p)<m){p=o-(Math.abs(k)+m);this._toggleControls("next",false);this._toggleControls("prev",true)}else{if(l==="prev"&&Math.abs(k)-p<0){p=Math.abs(k);this._toggleControls("next",true);this._toggleControls("prev",false)}else{var s=l==="next"?Math.abs(k)+Math.abs(p):Math.abs(k)-Math.abs(p);s>0?this._toggleControls("prev",true):this._toggleControls("prev",false);s<o-m?this._toggleControls("next",true):this._toggleControls("next",false)}}n=l==="next"?k-p:k+p}else{var p=Math.abs(n);if(Math.max(o,m)-p<m){n=-(Math.max(o,m)-m)}p>0?this._toggleControls("prev",true):this._toggleControls("prev",false);Math.max(o,m)-m>p?this._toggleControls("next",true):this._toggleControls("next",false)}this.translation=n;if(k===n){this._onEndTransition();return false}if(this.support){this.options.orientation==="horizontal"?this.$el.css("transform","translateX("+n+"px)"):this.$el.css("transform","translateY("+n+"px)")}else{g.fn.applyStyle=this.hasTransition?g.fn.animate:g.fn.css;var r=this.options.orientation==="horizontal"?{left:n}:{top:n};this.$el.stop().applyStyle(r,g.extend(true,[],{duration:this.options.speed,complete:function(){t._onEndTransition()}}))}if(!this.hasTransition){this._onEndTransition()}},_onEndTransition:function(){this.isSliding=false;this.options.onAfterSlide()},_slideTo:function(o){var o=o||this.current,n=Math.abs(this.translation)||0,m=this.options.orientation==="horizontal"?this.$items.outerWidth(true):this.$items.outerHeight(true),l=n+this.$carousel.width(),k=Math.abs(o*m);if(k+m>l||k<n){this._slideToItem(o)}},_slideToItem:function(l){var k=this.options.orientation==="horizontal"?l*this.$items.outerWidth(true):l*this.$items.outerHeight(true); this._slide("",-k)},add:function(n){var k=this,m=this.current,l=this.$items.eq(this.current);this.$items=this.$el.children("li");this.itemsCount=this.$items.length;this.current=l.index();this._setItemsSize();this._configure();this._removeTransition();m<this.current?this._slideToItem(this.current):this._slide("next",this.translation);setTimeout(function(){k._addTransition()},25);if(n){n.call()}},setCurrent:function(k,l){this.current=k;this._slideTo();if(l){l.call()}},next:function(){self._slide("next")},previous:function(){self._slide("prev")},slideStart:function(){this._slideTo(0)},slideEnd:function(){this._slideTo(this.itemsCount-1)},destroy:function(k){this._destroy(k)}};var i=function(k){if(h.console){h.console.error(k)}};g.fn.elastislide<?php echo $Total_Soft_Portfolio; ?>=function(m){var k=g.data(this,"elastislide<?php echo $Total_Soft_Portfolio; ?>");if(typeof m==="string"){var l=Array.prototype.slice.call(arguments,1);this.each(function(){if(!k){i("cannot call methods on elastislide<?php echo $Total_Soft_Portfolio; ?> prior to initialization; attempted to call method '"+m+"'");return}if(!g.isFunction(k[m])||m.charAt(0)==="_"){i("no such method '"+m+"' for elastislide<?php echo $Total_Soft_Portfolio; ?> self");return}k[m].apply(k,l)})}else{this.each(function(){if(k){k._init()}else{k=g.data(this,"elastislide<?php echo $Total_Soft_Portfolio; ?>",new g.Elastislide<?php echo $Total_Soft_Portfolio; ?>(m,this))}})}return k}})(jQuery,window);(function(c,b,d){c.HoverDir=function(e,f){this.$el=c(f);this._init(e)};c.HoverDir.defaults={speed:300,easing:"ease",hoverDelay<?php echo $Total_Soft_Portfolio; ?>:0,inverse:false};c.HoverDir.prototype={_init:function(e){this.options=c.extend(true,{},c.HoverDir.defaults,e);this.transitionProp="all "+this.options.speed+"ms "+this.options.easing;this.support=Modernizr.csstransitions;this._loadEvents()},_loadEvents:function(){var e=this;this.$el.on("mouseenter.hoverdir, mouseleave.hoverdir",function(i){var g=c(this),f=g.find("figure"),j=e._getDir(g,{x:i.pageX,y:i.pageY}),h=e._getStyle(j);if(i.type==="mouseenter"){f.hide().css(h.from);clearTimeout(e.tmhover);e.tmhover=setTimeout(function(){f.show(0,function(){var k=c(this);if(e.support){k.css("transition",e.transitionProp)}e._applyAnimation(k,h.to,e.options.speed)})},e.options.hoverDelay<?php echo $Total_Soft_Portfolio; ?>)}else{if(e.support){f.css("transition",e.transitionProp)}clearTimeout(e.tmhover);e._applyAnimation(f,h.from,e.options.speed)}})},_getDir:function(g,k){var f=g.width(),i=g.height(),e=(k.x-g.offset().left-(f/2))*(f>i?(i/f):1),l=(k.y-g.offset().top-(i/2))*(i>f?(f/i):1),j=Math.round((((Math.atan2(l,e)*(180/Math.PI))+180)/90)+3)%4;return j},_getStyle:function(k){var g,l,i={left:"0px",top:"-100%"},e={left:"0px",top:"100%"},h={left:"-100%",top:"0px"},f={left:"100%",top:"0px"},m={top:"0px"},j={left:"0px"};switch(k){case 0:g=!this.options.inverse?i:e;l=m;break;case 1:g=!this.options.inverse?f:h;l=j;break;case 2:g=!this.options.inverse?e:i;l=m;break;case 3:g=!this.options.inverse?h:f;l=j;break}return{from:g,to:l}},_applyAnimation:function(f,e,g){c.fn.applyStyle=this.support?c.fn.css:c.fn.animate;f.stop().applyStyle(e,c.extend(true,[],{duration:g+"ms"}))},};var a=function(e){if(b.console){b.console.error(e)}};c.fn.hoverdir=function(g){var e=c.data(this,"hoverdir");if(typeof g==="string"){var f=Array.prototype.slice.call(arguments,1);this.each(function(){if(!e){a("cannot call methods on hoverdir prior to initialization; attempted to call method '"+g+"'");return}if(!c.isFunction(e[g])||g.charAt(0)==="_"){a("no such method '"+g+"' for hoverdir instance");return}e[g].apply(e,f)})}else{this.each(function(){if(e){e._init()}else{e=c.data(this,"hoverdir",new c.HoverDir(g,this))}})}return e}})(jQuery,window);var $event=jQuery.event,$special,resizeTimeout;$special=$event.special.debouncedresize={setup:function(){jQuery(this).on("resize",$special.handler)},teardown:function(){jQuery(this).off("resize",$special.handler)},handler:function(e,a){var d=this,c=arguments,b=function(){e.type="debouncedresize";$event.dispatch.apply(d,c)};if(resizeTimeout){clearTimeout(resizeTimeout)}a?b():resizeTimeout=setTimeout(b,$special.threshold)},threshold:250};var BLANK="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";jQuery.fn.imagesLoaded=function(h){var e=this,j=jQuery.isFunction(jQuery.Deferred)?jQuery.Deferred():0,i=jQuery.isFunction(j.notify),b=e.find("img").add(e.filter("img")),c=[],g=[],d=[];if(jQuery.isPlainObject(h)){jQuery.each(h,function(k,l){if(k==="callback"){h=l}else{if(j){j[k](l)}}})}function f(){var k=jQuery(g),l=jQuery(d);if(j){if(d.length){j.reject(b,k,l)}else{j.resolve(b)}}if(jQuery.isFunction(h)){h.call(e,b,k,l)}}function a(k,l){if(k.src===BLANK||jQuery.inArray(k,c)!==-1){return}c.push(k);if(l){d.push(k)}else{g.push(k)}jQuery.data(k,"imagesLoaded",{isBroken:l,src:k.src});if(i){j.notifyWith(jQuery(k),[l,b,jQuery(g),jQuery(d)])}if(b.length===c.length){setTimeout(f);b.unbind(".imagesLoaded")}}if(!b.length){f()}else{b.bind("load.imagesLoaded error.imagesLoaded",function(k){a(k.target,k.type==="error")}).each(function(k,m){var n=m.src;var l=jQuery.data(m,"imagesLoaded");if(l&&l.src===n){a(m,l.isBroken);return}if(m.complete&&m.naturalWidth!==undefined){a(m,m.naturalWidth===0||m.naturalHeight===0);return}if(m.readyState||m.complete){m.src=BLANK;m.src=n}})}return j?j.promise(e):e};jQuery(function(){jQuery.elastic_grid<?php echo $Total_Soft_Portfolio; ?>={version:"1.0"};jQuery.fn.elastic_grid<?php echo $Total_Soft_Portfolio; ?>=function(G){G=jQuery.extend({},{items:null,filterEffect<?php echo $Total_Soft_Portfolio; ?>:"",hoverDirection<?php echo $Total_Soft_Portfolio; ?>:true,hoverDelay<?php echo $Total_Soft_Portfolio; ?>:0,hoverInverse<?php echo $Total_Soft_Portfolio; ?>:false,expandingHeight<?php echo $Total_Soft_Portfolio; ?>:500,expandingSpeed<?php echo $Total_Soft_Portfolio; ?>:300,callback:function(){}},G);var u=jQuery(this);var H=G.items.length;if(H==0){return false}u.html('<div class="wagwep-container wagwep-container<?php echo $Total_Soft_Portfolio; ?>"><nav id="porfolio-nav" class="clearfix porfolio-nav<?php echo $Total_Soft_Portfolio; ?>"><ul id="portfolio-filter" class="nav portfolio-filter<?php echo $Total_Soft_Portfolio; ?> nav-tabs clearfix"></ul></nav></div>');var g="";var o=jQuery('<ul id="og-grid<?php echo $Total_Soft_Portfolio; ?>" class="og-grid og-grid<?php echo $Total_Soft_Portfolio; ?>"></ul>');for(itemIdx=0;itemIdx<H;itemIdx++){if(G.items[itemIdx]!=undefined){var E=G.items[itemIdx];liObject=jQuery("<li></li>");tags=E.tags;strTag="";for(var C=tags.length-1;C>=0;C--){strTag+=","+tags[C]}strTag=strTag.substring(1);liObject.attr("data-tags",strTag);aObject=jQuery("<a></a>");aObject.attr("href","javascript:;;");imgObject=jQuery("<img/>");imgObject.attr("src",E.thumbnail[0]);imgObject.attr("data-largesrc",E.large[0]);spanObject=jQuery("<span></span>");spanObject.html(E.title[0]);figureObject=jQuery("<figure></figure>");figureObject.append(spanObject);imgObject.appendTo(aObject);figureObject.appendTo(aObject);aObject.appendTo(liObject);liObject.appendTo(o)}}if(G.filterEffect<?php echo $Total_Soft_Portfolio; ?>==""){G.filterEffect<?php echo $Total_Soft_Portfolio; ?>="moveup"}o.addClass("effect-"+G.filterEffect<?php echo $Total_Soft_Portfolio; ?>);o.appendTo(u);if(G.hoverDirection<?php echo $Total_Soft_Portfolio; ?>==true){o.find("li").each(function(){jQuery(this).hoverdir({hoverDelay<?php echo $Total_Soft_Portfolio; ?>:G.hoverDelay<?php echo $Total_Soft_Portfolio; ?>,inverse:G.hoverInverse<?php echo $Total_Soft_Portfolio; ?>})})}var m=u.find(".portfolio-filter<?php echo $Total_Soft_Portfolio; ?>");var x=o.find("li"),c={};numOfTag=0;x.each(function(J){var K=jQuery(this); if(K.data("tags")>0){ KTags = K.data("tags") + ''; var I=KTags.split(","); } else{ var I=K.data("tags").split(","); } K.attr("data-id",J);K.addClass("all");jQuery.each(I,function(i,L){L=jQuery.trim(L);K.addClass(L.toLowerCase().replace(" ","-"));if(!(L in c)){c[L]=[];numOfTag++}c[L].push(K)})});if(numOfTag>1){f(G.showAllText<?php echo $Total_Soft_Portfolio; ?>);jQuery.each(c,function(I,i){f(I)})}else{m.remove()}m.find("a").bind("click",function(I){k.find("li.og-expanded<?php echo $Total_Soft_Portfolio; ?>").find("a").trigger("click");k.find(".og-close<?php echo $Total_Soft_Portfolio; ?>").trigger("click");$this=jQuery(this);$this.css("outline","none");m.find(".current").removeClass("current");$this.parent().addClass("current");var J=$this.text().toLowerCase().replace(" ","-");var i=H;o.find("li").each(function(K,L){classie.remove(L,"hidden");classie.remove(L,"animate");if(!--i){setTimeout(function(){p(o.find("li"),J)},1)}});return false});function p(i,I){i.each(function(J,K){if(classie.has(K,I)){classie.toggle(K,"animate");classie.remove(K,"hidden")}else{classie.add(K,"hidden");classie.remove(K,"animate")}})}m.find("li:first").addClass("current");function f(K){var J=K.toLowerCase().replace(" ","-");if(K!=""){var i=jQuery("<li>");var I=jQuery("<a>",{html:K,"data-filter":"."+J,href:"#","class":"filter",}).appendTo(i);i.appendTo(m)}}var k=o,h=k.children("li"),y=-1,t=-1,F=0,q=10,w=jQuery(window),d,A=jQuery("html, body"),B={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd",msTransition:"MSTransitionEnd",transition:"transitionend"},j=B[Modernizr.prefixed("transition")],s=Modernizr.csstransitions,D={minHeight:G.expandingHeight<?php echo $Total_Soft_Portfolio; ?>,speed:G.expandingSpeed<?php echo $Total_Soft_Portfolio; ?>,easing:"ease"};function v(i){h=h.add(i);i.each(function(){var I=jQuery(this);I.data({offsetTop:I.offset().top,height:I.height()})});l(i)}function r(i){h.each(function(){var I=jQuery(this);I.data("offsetTop",I.offset().top);if(i){I.data("height",I.height())}})}function n(){l(h);w.on("debouncedresize",function(){F=0;t=-1;r();b();var i=jQuery.data(this,"preview");if(typeof i!="undefined"){z()}})}function l(i){i.on("click","span.og-close<?php echo $Total_Soft_Portfolio; ?>",function(){z();return false}).children("a").on("click",function(J){var I=jQuery(this).parent();I.removeClass("animate");y===I.index()?z(jQuery(this)):a(I);return false})}function b(){d={width:w.width(),height:w.height()}}function a(I){z();var J=jQuery.data(this,"preview"),i=I.data("offsetTop");F=0;if(typeof J!="undefined"){if(t!==i){if(i>t){F=J.height}z()}else{J.update(I);return false}}t=i;J=jQuery.data(this,"preview",new e(I));J.open()}function z(){h.find(".og-pointer<?php echo $Total_Soft_Portfolio; ?>").remove();y=-1;var i=jQuery.data(this,"preview");if(typeof i=="undefined"){}else{i.close()}jQuery.removeData(this,"preview")}function e(i){this.$item=i;this.expandedIdx=this.$item.index();this.create();this.update()}e.prototype={create:function(){this.$title=jQuery("<h3></h3>");this.$description=jQuery("<p></p>");this.$href=jQuery('<a href="#">Visit website</a>');this.$detailButtonList=jQuery('<span class="buttons-list"></span>');this.$details=jQuery('<div class="og-details og-details<?php echo $Total_Soft_Portfolio; ?>"></div>').append(this.$title,this.$description,this.$detailButtonList);this.$loading=jQuery('<div class="og-loading"></div>');this.$fullimage=jQuery('<div class="og-fullimg"></div>').append(this.$loading);this.$closePreview=jQuery('<span class="og-close og-close<?php echo $Total_Soft_Portfolio; ?> totalsoft"></span>');this.$previewInner=jQuery('<div class="og-expander-inner"></div>').append(this.$closePreview,this.$fullimage,this.$details);this.$previewEl=jQuery('<div class="og-expander og-expander<?php echo $Total_Soft_Portfolio; ?>"></div>').append(this.$previewInner);this.$item.append(jQuery('<div class="og-pointer og-pointer<?php echo $Total_Soft_Portfolio; ?>"></div>'));this.$item.append(this.getEl());if(s){this.setTransition()}},update:function(L){if(L){this.$item=L}if(y!==-1){var K=h.eq(y);K.removeClass("og-expanded<?php echo $Total_Soft_Portfolio; ?>");this.$item.addClass("og-expanded<?php echo $Total_Soft_Portfolio; ?>");this.positionPreview()}y=this.$item.index();if(typeof G.items[y]==="undefined"){}else{eldata=G.items[y];this.$title.html(eldata.title[0]);this.$description.html(eldata.description[0]);this.$detailButtonList.html("");urlList=eldata.button_list;if(urlList.length>0){for(C=0;C<urlList.length;C++){var M=(urlList[C]["new_window"])?"_blank":"_self";var P=jQuery('<a target="'+M+'"></a>');P.addClass("link-button");if(C==0){P.addClass("first")}P.attr("href",urlList[C]["url"][0]);P.html(urlList[C]["title"]);this.$detailButtonList.append(P);if(P.attr("href")==""){P.css("display","none")}else{P.css("display","inline")}}}var O=this;if(typeof O.$largeImg!="undefined"){O.$largeImg.remove()}glarge=eldata.large;gthumbs=eldata.thumbnail;gtitle=eldata.title;gdescription=eldata.description;glink=eldata.button_list;if(glarge.length==gthumbs.length&&glarge.length>0){var i=jQuery("<ul></ul>");for(C=0;C<gthumbs.length;C++){var I=jQuery("<li></li>");var P=jQuery('<a href="javascript:;;"></a>');var J=jQuery("<img/>");J.addClass("related_photo");if(C==0){J.addClass("selected")}J.attr("src",gthumbs[C]);J.attr("data-large",glarge[C]);J.attr("name",gtitle[C]);J.attr("data-desc",gdescription[C]);J.attr("data-link",glink[0].url[C]);P.append(J);I.append(P);i.append(I)}i.addClass("elastislide<?php echo $Total_Soft_Portfolio; ?>-list");i.elastislide<?php echo $Total_Soft_Portfolio; ?>();var N=jQuery('<div class="elastislide<?php echo $Total_Soft_Portfolio; ?>-wrapper elastislide<?php echo $Total_Soft_Portfolio; ?>-horizontal"></div>');N.append(i).find(".related_photo").bind("click",function(){N.find(".selected").removeClass("selected");jQuery(this).addClass("selected");$largePhoto=jQuery(this).data("large");jQuery("<img/>").load(function(){O.$fullimage.find("img").fadeOut(500,function(){jQuery(this).fadeIn(500).attr("src",$largePhoto)})}).attr("src",$largePhoto);jQuery(".og-details<?php echo $Total_Soft_Portfolio; ?> h3").text(N.find(".selected").attr("name"));jQuery(".og-details<?php echo $Total_Soft_Portfolio; ?> p").html(N.find(".selected").attr("data-desc"));jQuery(".og-details<?php echo $Total_Soft_Portfolio; ?> a.link-button").attr("href",N.find(".selected").attr("data-link"));if(jQuery(".og-details<?php echo $Total_Soft_Portfolio; ?> a.link-button").attr("href")==""){jQuery(".og-details<?php echo $Total_Soft_Portfolio; ?> a.link-button").css("display","none")}else{jQuery(".og-details<?php echo $Total_Soft_Portfolio; ?> a.link-button").css("display","inline")}});O.$details.append('<div class="infosep"></div>');O.$details.append(N)}else{O.$details.find(".infosep, .og-grid-small").remove()}if(O.$fullimage.is(":visible")){this.$loading.show();jQuery("<img/>").load(function(){var Q=jQuery(this);if(Q.attr("src")===O.$item.children("a").find("img").data("largesrc")){O.$loading.hide();O.$fullimage.find("img").remove();O.$largeImg=Q.fadeIn(350);O.$fullimage.append(O.$largeImg)}}).attr("src",eldata.large[0])}}},open:function(){setTimeout(jQuery.proxy(function(){this.setHeights();this.positionPreview()},this),25)},close:function(){var i=this,I=function(){if(s){jQuery(this).off(j)}i.$item.removeClass("og-expanded<?php echo $Total_Soft_Portfolio; ?>"); i.$previewEl.remove()};setTimeout(jQuery.proxy(function(){if(typeof this.$largeImg!=="undefined"){this.$largeImg.fadeOut("fast")}this.$previewEl.css("height",0);var J=h.eq(this.expandedIdx);J.css("height",J.data("height")).on(j,I);if(!s){I.call()}},this),25);return false},calcHeight:function(){var I=D.minHeight,i=D.minHeight+this.$item.data("height")+q; this.height=I; this.itemHeight=i},setHeights:function(){var i=this,I=function(){if(s){i.$item.off(j)}i.$item.addClass("og-expanded<?php echo $Total_Soft_Portfolio; ?>")};this.calcHeight(); this.$previewEl.css("height",this.height); this.$item.css("height",this.itemHeight).on(j,I);if(!s){I.call()}},positionPreview:function(){var I=this.$item.data("offsetTop"),i=this.$previewEl.offset().top-F,J=this.height+this.$item.data("height")+q<=d.height?I:this.height<d.height?i-(d.height-this.height):i; A.animate({scrollTop:J},D.speed)},setTransition:function(){this.$previewEl.css("transition","height "+D.speed+"ms "+D.easing);this.$item.css("transition","height "+D.speed+"ms "+D.easing)},getEl:function(){return this.$previewEl}};k.imagesLoaded(function(){r(true);b();n()})}});
				</script>
				<script type="text/javascript">
					jQuery(function(){
						jQuery("#elastic_grid_demo<?php echo $Total_Soft_Portfolio; ?>").elastic_grid<?php echo $Total_Soft_Portfolio; ?>({
							'showAllText<?php echo $Total_Soft_Portfolio; ?>' : '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01;?>',
							'filterEffect<?php echo $Total_Soft_Portfolio; ?>': '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?>',
							'hoverDirection<?php echo $Total_Soft_Portfolio; ?>': <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>,
							'hoverDelay<?php echo $Total_Soft_Portfolio; ?>': <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05;?>,
							'hoverInverse<?php echo $Total_Soft_Portfolio; ?>': <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>,
							'expandingSpeed<?php echo $Total_Soft_Portfolio; ?>': <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?>,
							'expandingHeight<?php echo $Total_Soft_Portfolio; ?>': <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>,
							'items' :
							[
								<?php for($i=0;$i<$TotalSoftPortfolioManager[0]->TotalSoftPortfolio_AlbumCount;$i++){
									$TSoftPort_ElGrid_Images=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE TotalSoftPortfolio_IA = %s and Portfolio_ID = %s order by id", $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle, $Total_Soft_Portfolio));
										for($j=0;$j<count($TSoftPort_ElGrid_Images);$j++){ ?>
											{
												'title'         : [ <?php echo "'" . html_entity_decode($TSoftPort_ElGrid_Images[$j]->TotalSoftPortfolio_IT) . "',"; for($k=0;$k<count($TSoftPort_ElGrid_Images);$k++){ if($j!=$k){echo "'" . html_entity_decode($TSoftPort_ElGrid_Images[$k]->TotalSoftPortfolio_IT) . "',";}}?> ],
												'description'   : [ <?php echo "'" . html_entity_decode($TSoftPort_ElGrid_Images[$j]->TotalSoftPortfolio_IDesc) . "',"; for($k=0;$k<count($TSoftPort_ElGrid_Images);$k++){ if($j!=$k){echo "'" . html_entity_decode($TSoftPort_ElGrid_Images[$k]->TotalSoftPortfolio_IDesc) . "',";}}?> ],
												'thumbnail'     : [ <?php echo "'" . $TSoftPort_ElGrid_Images[$j]->TotalSoftPortfolio_IURL . "',"; for($k=0;$k<count($TSoftPort_ElGrid_Images);$k++){ if($j!=$k){echo "'" . $TSoftPort_ElGrid_Images[$k]->TotalSoftPortfolio_IURL . "',";}}?> ],
												'large'         : [ <?php echo "'" . $TSoftPort_ElGrid_Images[$j]->TotalSoftPortfolio_IURL . "',"; for($k=0;$k<count($TSoftPort_ElGrid_Images);$k++){ if($j!=$k){echo "'" . $TSoftPort_ElGrid_Images[$k]->TotalSoftPortfolio_IURL . "',";}}?> ],
												'button_list'   :
												[
													{ 'title':'View More', 'url':[ <?php echo "'" . $TSoftPort_ElGrid_Images[$j]->TotalSoftPortfolio_ILink . "',"; for($k=0;$k<count($TSoftPort_ElGrid_Images);$k++){ if($j!=$k){echo "'" . $TSoftPort_ElGrid_Images[$k]->TotalSoftPortfolio_ILink . "',";}}?> ], 'new_window' : '<?php echo $TSoftPort_ElGrid_Images[$j]->TotalSoftPortfolio_IONT; ?>' }
												],
												'tags'          : ['<?php echo $TSoftPort_ElGrid_Images[$j]->TotalSoftPortfolio_IA;?>']
											},
								<?php }} ?>
							]
						});
					});
				</script>
			<?php }else if($TotalSoftPortfolioOpt[0]->TotalSoftPortfolio_SetType == 'Filterable Grid'){ ?>
				<style type="text/css">
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02!='0'){ ?>
						.slider<?php echo $Total_Soft_Portfolio; ?>
						{
							padding: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02;?>px;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?>;
						}
					<?php } else{ ?>
						.slider<?php echo $Total_Soft_Portfolio; ?>
						{
							padding:0;
							background:none !important;
						}
					<?php } ?>
					.grid__sizer<?php echo $Total_Soft_Portfolio; ?>,.grid__item<?php echo $Total_Soft_Portfolio; ?>
					{
						padding:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>px;
						box-sizing:border-box;
						-moz-box-sizing:border-box;
						-webkit-box-sizing:border-box;
					}
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "Effect 1" || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "#ffffff" || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == ""){ ?>
						.bar<?php echo $Total_Soft_Portfolio; ?>
						{
							text-align: center;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>
						{
							color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
							background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?> !important;
							font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>px;
							font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12;?> !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?> !important;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?> !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?> !important;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> !important;
							border: none !important;
							box-shadow: none !important;
							-moz-box-shadow: none !important;
							-webkit-box-shadow: none !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:active, .filter__item<?php echo $Total_Soft_Portfolio; ?>:focus
						{
							border: none !important;
							box-shadow: none !important;
							-moz-box-shadow: none !important;
							-webkit-box-shadow: none !important;
						}
					<?php } elseif($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "Effect 2") { ?>
						.bar<?php echo $Total_Soft_Portfolio; ?>
						{
							text-align: center;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>;
							height:40px;
							padding:0px !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>
						{
							color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
							background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?> !important;
							font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>px;
							font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12;?> !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?> !important;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?> !important;
							transform: scale(1.1);
							-moz-transform: scale(1.1);
							-webkit-transform: scale(1.1);
							box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.75) !important;
							-moz-box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.75) !important;
							-webkit-box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.75) !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?> !important;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> !important;
							transform: scale(1.1);
							-moz-transform: scale(1.1);
							-webkit-transform: scale(1.1);
							z-index: 2;
							border: none !important;
							box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.75) !important;
							-moz-box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.75) !important;
							-webkit-box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.75) !important;
							transition: all 0.3s ease-in 0s !important;
							-moz-transition: all 0.3s ease-in 0s !important;
							-webkit-transition: all 0.3s ease-in 0s !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:active, .filter__item<?php echo $Total_Soft_Portfolio; ?>:focus
						{
							transform: scale(1.1);
							-moz-transform: scale(1.1);
							-webkit-transform: scale(1.1);
							z-index: 2;
							border: none !important;
							box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.75) !important;
							-moz-box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.75) !important;
							-webkit-box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.75) !important;
							transition: all 0.3s ease-in 0s !important;
							-moz-transition: all 0.3s ease-in 0s !important;
							-webkit-transition: all 0.3s ease-in 0s !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>
						{
							font-weight: bold !important;
							margin: 0 0 !important;
							padding:3px 10px !important;
							vertical-align: middle;
							line-height: 1 !important;
							text-transform: none !important;
							height:40px;
						}
					<?php } elseif($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "Effect 3") { ?>
						.bar<?php echo $Total_Soft_Portfolio; ?>
						{
							text-align: center;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>;
							min-height:40px;
							padding:0px !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>
						{
							color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
							background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?> !important;
							font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>px;
							font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12;?> !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?> !important;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?> !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?> !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>
						{
							font-weight: bold !important;
							position:relative;
							margin: 0 0 !important;
							padding:0px !important;
							vertical-align: middle;
							line-height: 1 !important;
							text-transform: none !important;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-moz-box-sizing:border-box;
							min-height:40px;
							min-width:100px;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?> span
						{
							width:100%;
							height:100%;
							display:inline-block;
							box-sizing:border-box;
							-webkit-box-sizing:border-box;
							-moz-box-sizing:border-box;
							vertical-align: middle;
							line-height: 2 !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:before
						{
							content: "";
							position: absolute;
							top: -10px;
							left: 10%;
							width: 10px;
							height: 10px;
							border-radius: 50%;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> !important;
							opacity: 1;
							-webkit-transition: top 0.4s linear 0s;
							-moz-transition: top 0.4s linear 0s;
							transition: top 0.4s linear 0s;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?> span:before
						{
							content: "";
							position: absolute;
							top: -30px;
							left: 50%;
							width: 20px;
							height: 20px;
							border-radius: 55%;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> !important;
							opacity: 1;
							-webkit-transition: top 0.4s linear 0s;
							-moz-transition: top 0.4s linear 0s;
							transition: top 0.4s linear 0s;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover:before
						{
							top: 30%;
							-webkit-transition: top 0.2s ease-in-out 0s;
							-moz-transition: top 0.2s ease-in-out 0s;
							transition: top 0.2s ease-in-out 0s;
							-webkit-animation-duration: 1s;
							-moz-animation-duration: 1s;
							animation-duration: 1s;
							-webkit-animation-delay: 0.2s;
							-moz-animation-delay: 0.2s;
							animation-delay: 0.2s;
							-webkit-animation-name: bounce-bubbles1;
							-moz-animation-name: bounce-bubbles1;
							animation-name: bounce-bubbles1;
							-webkit-animation-iteration-count: infinite;
							-moz-animation-iteration-count: infinite;
							animation-iteration-count: infinite;
							-webkit-animation-direction: alternate;
							-moz-animation-direction: alternate;
							animation-direction: alternate;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover .tot_hov_span:before
						{
							top: 5%;
							-webkit-transition: top 0.2s ease-in-out 0.1s;
							-moz-transition: top 0.2s ease-in-out 0.1s;
							transition: top 0.2s ease-in-out 0.1s;
							-webkit-animation-duration: 1.2s;
							-moz-animation-duration: 1.2s;
							animation-duration: 1.2s;
							-webkit-animation-delay: 0.3s;
							-moz-animation-delay: 0.3s;
							animation-delay: 0.3s;
							-webkit-animation-name: bounce-bubbles3;
							-moz-animation-name: bounce-bubbles3;
							animation-name: bounce-bubbles3;
							-webkit-animation-iteration-count: infinite;
							-moz-animation-iteration-count: infinite;
							animation-iteration-count: infinite;
							-webkit-animation-direction: alternate;
							-moz-animation-direction: alternate;
							animation-direction: alternate;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:after
						{
							content: "";
							position: absolute;
							top: -40px;
							left: 25%;
							width: 20px;
							height: 20px;
							border-radius: 50%;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> !important;
							opacity: 1;
							-webkit-transition: top 0.4s linear 0s;
							-moz-transition: top 0.4s linear 0s;
							transition: top 0.4s linear 0s;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?> span:after
						{
							content: "";
							position: absolute;
							top: -15px;
							left: 73%;
							width: 15px;
							height: 15px;
							border-radius: 50%;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> !important;
							opacity: 1;
							-webkit-transition: top 0.4s linear 0s;
							-moz-transition: top 0.4s linear 0s;
							transition: top 0.4s linear 0s;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover:after
						{
							top: 10%;
							-webkit-transition: top 0.4s ease-in-out 0.2s;
							-moz-transition: top 0.4s ease-in-out 0.2s;
							transition: top 0.4s ease-in-out 0.2s;
							-webkit-animation-duration: 1.1s;
							-moz-animation-duration: 1.1s;
							animation-duration: 1.1s;
							-webkit-animation-delay: 0.6s;
							-moz-animation-delay: 0.6s;
							animation-delay: 0.6s;
							-webkit-animation-name: bounce-bubbles2;
							-moz-animation-name: bounce-bubbles2;
							animation-name: bounce-bubbles2;
							-webkit-animation-iteration-count: infinite;
							-moz-animation-iteration-count: infinite;
							animation-iteration-count: infinite;
							-webkit-animation-direction: alternate;
							-moz-animation-direction: alternate;
							animation-direction: alternate;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover .tot_hov_span:after
						{
							top: 10% !important;
							-webkit-transition: top 0.4s ease-in-out 0.2s;
							-moz-transition: top 0.4s ease-in-out 0.2s;
							transition: top 0.4s ease-in-out 0.2s;
							-webkit-animation-duration: 1.1s;
							-moz-animation-duration: 1.1s;
							animation-duration: 1.1s;
							-webkit-animation-delay: 0.6s;
							-moz-animation-delay: 0.6s;
							animation-delay: 0.6s;
							-webkit-animation-name: bounce-bubbles4;
							-moz-animation-name: bounce-bubbles4;
							animation-name: bounce-bubbles4;
							-webkit-animation-iteration-count: infinite;
							-moz-animation-iteration-count: infinite;
							animation-iteration-count: infinite;
							-webkit-animation-direction: alternate;
							-moz-animation-direction: alternate;
							animation-direction: alternate;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected:before
						{
							top: 30%;
							-webkit-transition: top 0.2s ease-in-out 0s;
							-moz-transition: top 0.2s ease-in-out 0s;
							transition: top 0.2s ease-in-out 0s;
							-webkit-animation-duration: 1s;
							-moz-animation-duration: 1s;
							animation-duration: 1s;
							-webkit-animation-delay: 0.2s;
							-moz-animation-delay: 0.2s;
							animation-delay: 0.2s;
							-webkit-animation-name: bounce-bubbles1;
							-moz-animation-name: bounce-bubbles1;
							animation-name: bounce-bubbles1;
							-webkit-animation-iteration-count: infinite;
							-moz-animation-iteration-count: infinite;
							animation-iteration-count: infinite;
							-webkit-animation-direction: alternate;
							-moz-animation-direction: alternate;
							animation-direction: alternate;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected:after
						{
							top: 50%;
							-webkit-transition: top 0.2s ease-in-out 0.2s;
							-moz-transition: top 0.2s ease-in-out 0.2s;
							transition: top 0.2s ease-in-out 0.2s;
							-webkit-animation-duration: 1.3s;
							-moz-animation-duration: 1.3s;
							animation-duration: 1.3s;
							-webkit-animation-delay: 0.4s;
							-moz-animation-delay: 0.4s;
							animation-delay: 0.4s;
							-webkit-animation-name: bounce-bubbles4;
							-moz-animation-name: bounce-bubbles4;
							animation-name: bounce-bubbles4;
							-webkit-animation-iteration-count: infinite;
							-moz-animation-iteration-count: infinite;
							animation-iteration-count: infinite;
							-webkit-animation-direction: alternate;
							-moz-animation-direction: alternate;
							animation-direction: alternate;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected span:before
						{
							top: 5%;
							-webkit-transition: top 0.2s ease-in-out 0.1s;
							-moz-transition: top 0.2s ease-in-out 0.1s;
							transition: top 0.2s ease-in-out 0.1s;
							-webkit-animation-duration: 1.2s;
							-moz-animation-duration: 1.2s;
							animation-duration: 1.2s;
							-webkit-animation-delay: 0.3s;
							-moz-animation-delay: 0.3s;
							animation-delay: 0.3s;
							-webkit-animation-name: bounce-bubbles3;
							-moz-animation-name: bounce-bubbles3;
							animation-name: bounce-bubbles3;
							-webkit-animation-iteration-count: infinite;
							-moz-animation-iteration-count: infinite;
							animation-iteration-count: infinite;
							-webkit-animation-direction: alternate;
							-moz-animation-direction: alternate;
							animation-direction: alternate;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected span:after
						{
							top: 10%;
							-webkit-transition: top 0.4s ease-in-out 0.2s;
							-moz-transition: top 0.4s ease-in-out 0.2s;
							transition: top 0.4s ease-in-out 0.2s;
							-webkit-animation-duration: 1.1s;
							-moz-animation-duration: 1.1s;
							animation-duration: 1.1s;
							-webkit-animation-delay: 0.6s;
							-moz-animation-delay: 0.6s;
							animation-delay: 0.6s;
							-webkit-animation-name: bounce-bubbles4;
							-moz-animation-name: bounce-bubbles4;
							animation-name: bounce-bubbles4;
							-webkit-animation-iteration-count: infinite;
							-moz-animation-iteration-count: infinite;
							animation-iteration-count: infinite;
							-webkit-animation-direction: alternate;
							-moz-animation-direction: alternate;
							animation-direction: alternate;
						}
						@-webkit-keyframes bounce-bubbles1 { from { top: 30%; } to { top: calc(100% - 30% - 10px); } }
						@-webkit-keyframes bounce-bubbles2 { from { top: 18%; } to { top: 32%; } } 
						@-webkit-keyframes bounce-bubbles3 { from { top: 5%; } to { top: 16%; } }
						@-webkit-keyframes bounce-bubbles4 { from { top: 50%; } to { top: 60%; } }
						@keyframes bounce-bubbles1 { from { top: 30%; } to { top: calc(100% - 30% - 10px); } }
						@keyframes bounce-bubbles2 { from { top: 18%; } to { top: 32%; } }
						@keyframes bounce-bubbles3 { from { top: 5%; } to { top: 16%; } }
						@keyframes bounce-bubbles4 { from { top: 50%; } to { top: 60%; } }
					<?php } elseif($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "Effect 4") { ?>
						.bar<?php echo $Total_Soft_Portfolio; ?>
						{
							text-align: center;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>;
							min-height:40px;
							padding:0px !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>
						{
							color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
							background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?> !important;
							font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>px;
							font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12;?> !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?> !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?> !important;
							border: none !important;
							transition: all 0.3s ease-in 0s !important;
							-moz-transition: all 0.3s ease-in 0s !important;
							-webkit-transition: all 0.3s ease-in 0s !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:active, .filter__item<?php echo $Total_Soft_Portfolio; ?>:focus
						{
							border: none !important;
							transition: all 0.3s ease-in 0s !important;
							-moz-transition: all 0.3s ease-in 0s !important;
							-webkit-transition: all 0.3s ease-in 0s !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>
						{
							font-weight: bold !important;
							margin: 0 0 !important;
							padding:0px !important;
							text-align:center;
							vertical-align: middle;
							line-height: 1 !important;
							text-transform: none !important;
							min-height:40px;
							min-width:100px;
							z-index: 0;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:before
						{
							content: "";
							position: absolute;
							z-index:-1;
							left:0px !important;
							bottom: 15px;
							width: 100%;
							height: 2px;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> !important;
							-webkit-transform: scalex(0);
							-moz-transform: scalex(0);
							transform: scalex(0);
							-webkit-transition: height 0.2s ease-in-out 0s, bottom 0.2s ease-in-out 0s, -webkit-transform 0.2s ease-in-out 0.2s;
							transition: height 0.2s ease-in-out 0s, bottom 0.2s ease-in-out 0s, -webkit-transform 0.2s ease-in-out 0.2s;
							transition: transform 0.2s ease-in-out 0.2s, height 0.2s ease-in-out 0s, bottom 0.2s ease-in-out 0s;
							transition: transform 0.2s ease-in-out 0.2s, height 0.2s ease-in-out 0s, bottom 0.2s ease-in-out 0s, -webkit-transform 0.2s ease-in-out 0.2s;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover:before
						{
							-webkit-transform: scalex(1);
							-moz-transform: scalex(1);
							transform: scalex(1);
							height: 100%;
							bottom: 0;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> !important;
							-webkit-transition: height 0.2s ease-in-out 0.2s, bottom 0.2s ease-in-out 0.2s, -webkit-transform 0.2s ease-in-out 0s;
							transition: height 0.2s ease-in-out 0.2s, bottom 0.2s ease-in-out 0.2s, -webkit-transform 0.2s ease-in-out 0s;
							transition: transform 0.2s ease-in-out 0s, height 0.2s ease-in-out 0.2s, bottom 0.2s ease-in-out 0.2s;
							transition: transform 0.2s ease-in-out 0s, height 0.2s ease-in-out 0.2s, bottom 0.2s ease-in-out 0.2s, -webkit-transform 0.2s ease-in-out 0s;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected:before
						{
							content: "";
							position: absolute;
							z-index: -1;
							left: 0px !important;
							-webkit-transform: scale(1,1) !important;
							-moz-transform: scale(1,1) !important;
							transform: scale(1,1) !important;
							height: 100%;
							width:100%;
							bottom: 0;
							opacity:1 !important;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?> !important;
						}
					<?php } elseif($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "Effect 5") { ?>
						.bar<?php echo $Total_Soft_Portfolio; ?>
						{
							text-align: center;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>;
							min-height:40px;
							padding:0px !important;
							overflow:visible !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>
						{
							color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
							background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?> !important;
							font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>px;
							font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12;?> !important;
							overflow:visible !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected .tot_hov_span
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?> !important;
							top: -20px;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?> !important;
							box-shadow: 0 0 5px 0 #000000;
							-moz-box-shadow: 0 0 5px 0 #000000;
							-webkit-box-shadow: 0 0 5px 0 #000000;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected .tot_hov_span:after
						{
							border-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?> transparent transparent transparent;
							transition: all .4s;
							-moz-transition: all .4s;
							-webkit-transition: all .4s;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>
						{
							font-weight: bold !important;
							margin: 0 0 !important;
							padding:5px 10px !important;
							text-align:center;
							vertical-align: middle;
							line-height: 1 !important;
							text-transform: none !important;
							min-height:40px;
							min-width:100px;
						}
						.tot_hov_span
						{
							position:relative;
							padding:5px 10px;
							display:inline-block;
							top:0px;
							width:100%;
							height:100%;
							border-radius:4px;
							transition: all .4s;
							-moz-transition: all .4s;
							-webkit-transition: all .4s;
							box-sizing: border-box;
							-moz-box-sizing: border-box;
							-webkit-box-sizing: border-box;
						}
						.tot_hov_span:after
						{
							display: block;
							content: '';
							position: absolute;
							top: 100%;
							left: 42%;
							border-style: solid;
							border-color: transparent;
							border-width: 5px 5px 0 5px;
							transition: all .4s;
							-moz-transition: all .4s;
							-webkit-transition: all .4s;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover .tot_hov_span
						{
							top: -20px;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?>;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> !important;
							box-shadow: 0 0 5px 0 #000000;
							-moz-box-shadow: 0 0 5px 0 #000000;
							-webkit-box-shadow: 0 0 5px 0 #000000;
							transition: all .4s;
							-moz-transition: all .4s;
							-webkit-transition: all .4s;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover .tot_hov_span:after
						{
							border-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> transparent transparent transparent;
							transition: all .4s;
							-moz-transition: all .4s;
							-webkit-transition: all .4s;
						}
					<?php } elseif($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "Effect 6") { ?>
						.bar<?php echo $Total_Soft_Portfolio; ?>
						{
							text-align: center !important;
							min-height:40px;
							padding:0px !important;
							overflow:visible !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>
						{
							color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
							background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?> !important;
							font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>px;
							font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12;?> !important;
							overflow:visible !important;
							transition: all .4s;
							-moz-transition: all .4s;
							-webkit-transition: all .4s;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>
						{
							font-weight: bold !important;
							margin: 0 0 !important;
							padding:5px 10px !important;
							text-align:center;
							vertical-align: middle;
							line-height: 1 !important;
							text-transform: none !important;
							min-height:40px;
							min-width:100px;
							display:block;
							float:left;
							position: relative !important;
						}
						.bar<?php echo $Total_Soft_Portfolio; ?> .filter { display:inline-block; }
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:before
						{
							content: "";
							display: block;
							height: 0;
							border-top: 5px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?> !important;
							border-left: 50px solid transparent;
							border-right: 50px solid transparent;
							border-bottom: 0 solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?> !important;
							position: absolute;
							top: 100%;
							left: 50%;
							transform:translateX(-50%);
							-webkit-transform:translateX(-50%);
							-ms-transform:translateX(-50%);
							-moz-transform:translateX(-50%);
							-o-transform:translateX(-50%);
							z-index: 101;
							transition: 0.2s 0.2s border-top ease-out, 0.3s border-top-color;
							-moz-transition: 0.2s 0.2s border-top ease-out, 0.3s border-top-color;
							-webkit-transition: 0.2s 0.2s border-top ease-out, 0.3s border-top-color;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:after
						{
							content: "";
							display: block;
							height: 0;
							border-left: 50px solid transparent;
							border-right: 50px solid transparent;
							border-bottom: 0 solid #ebebeb;
							position: absolute;
							bottom: 0;
							left: 0;
							z-index: 101;
							transition: 0.2s border-bottom ease-in;
							-moz-transition: 0.2s border-bottom ease-in;
							-webkit-transition: 0.2s border-bottom ease-in;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected:before { border-top-width: 0 !important; }
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected:after { border-bottom-width: 5px; }
						.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected
						{
							background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?> !important;
							color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?> !important;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover:before
						{
							border-top-width: 0 !important;
							transition: 0.2s border-top-width ease-in, 0.3s border-top-color;
							-moz-transition: 0.2s border-top-width ease-in, 0.3s border-top-color;
							-webkit-transition: 0.2s border-top-width ease-in, 0.3s border-top-color;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover:after
						{
							border-bottom-width: 5px;
							transition: 0.2s 0.2s border-bottom-width ease-out;
							-moz-transition: 0.2s 0.2s border-bottom-width ease-out;
							-webkit-transition: 0.2s 0.2s border-bottom-width ease-out;
						}
						.filter__item<?php echo $Total_Soft_Portfolio; ?>:hover
						{
							background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> !important;
							color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?> !important;
						}
					<?php } ?>
					.grid__item<?php echo $Total_Soft_Portfolio; ?> .meta
					{
						text-align: center;
						background-color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?>;
					}
					.meta__title<?php echo $Total_Soft_Portfolio; ?>
					{
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?>px !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?> !important;
						margin: 0 !important;
						text-transform: none !important;
						letter-spacing: 0 !important;
						font-weight: 400 !important;
						line-height: 1 !important;
					}
					.meta__brand { line-height: 1 !important; }
					.action--button { color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>; }
					.no-touch .action--button:hover { color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>; }
					.hoverDivPort { position:absolute; top:0px; left:0px; width:100%; height:100%; cursor:pointer; }
					.HovLine1_1
					{
						position:absolute;
						width:0%;
						top:50%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
					}
					.HovLine2_1
					{
						position:absolute;
						width:0%;
						top:50%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
					}
					.HovLine1_2
					{
						position:absolute;
						width:0%;
						top:50%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
					}
					.HovLine2_2
					{
						position:absolute;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>px;
						width:0%;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
					}
					.HovLine1_3
					{
						position:absolute;
						width:0%;
						top:50%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(90deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
					}
					.HovLine2_3
					{
						position:absolute;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>px;
						width:0%;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
					}
					.HovLine1_4
					{
						position:absolute;
						width:35%;
						top:50%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
					}
					.HovLine2_4
					{
						position:absolute;
						width:35%;
						top:50%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
					}
					.HovLine1_5
					{
						position:absolute;
						width:35%;
						top:50%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
					}
					.HovLine2_5
					{
						position:absolute;
						width:35%;
						top:50%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
					}
					.HovLine1_6
					{
						position:absolute;
						width:0%;
						top:50%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
					}
					.HovLine2_6
					{
						position:absolute;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>px;
						width:0%;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
					}
					.HovLine1_7
					{
						position:absolute;
						width:500%;
						top:55%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
					}
					.HovLine2_7
					{
						position:absolute;
						width:500%;
						top:40%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
					}
					.HovLine1_8
					{
						position:absolute;
						width:500%;
						top:55%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
					}
					.HovLine2_8
					{
						position:absolute;
						width:500%;
						top:40%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
					}
					.HovLine1_9
					{
						position:absolute;
						width:0%;
						top:0%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
					}
					.HovLine2_9
					{
						position:absolute;
						width:0%;
						top:100%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
					}
					.HovLine1_10
					{
						position:absolute;
						width:0%;
						top:100%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31/10;?>s linear !important;
					}
					.HovLine2_10
					{
						position:absolute;
						width:0%;
						top:0%;
						left:50%;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>px;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36/10;?>s linear !important;
					}
					.slider__item:hover .HovLine1_1
					{
						width:35%;
						opacity:1;
						transform:translateY(-50%) translateX(-50%) rotate(270deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(270deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(270deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(270deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(270deg);
					}
					.slider__item:hover .HovLine2_1
					{
						width:35%;
						opacity:1;
						transform:translateY(-50%) translateX(-50%) rotate(180deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(180deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(180deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(180deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(180deg);
					}
					.slider__item:hover .HovLine1_2
					{
						width:35%;
						opacity:1;
						transform:translateY(-50%) translateX(-50%) rotate(-270deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(-270deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(-270deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(-270deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(-270deg);
					}
					.slider__item:hover .HovLine2_2
					{
						width:35%;
						opacity:1;
						transform:translateY(-50%) translateX(-50%) rotate(-180deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(-180deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(-180deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(-180deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(-180deg);
					}
					.slider__item:hover .HovLine1_3 { width:35% !important; opacity:1; }
					.slider__item:hover .HovLine2_3 { width:35%; opacity:1; }
					.slider__item:hover .HovLine1_4
					{
						width:35%;
						opacity:1;
						transform:translateY(-50%) translateX(-50%) rotate(315deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(315deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(315deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(315deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(315deg);
					}
					.slider__item:hover .HovLine2_4
					{
						width:35%;
						opacity:1;
						transform:translateY(-50%) translateX(-50%) rotate(225deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(225deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(225deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(225deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(225deg);
					}
					.slider__item:hover .HovLine1_5
					{
						width:35%;
						opacity:1;
						transform:translateY(-50%) translateX(-50%) rotate(-315deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(-315deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(-315deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(-315deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(-315deg);
					}
					.slider__item:hover .HovLine2_5
					{
						width:35%;
						opacity:1;
						transform:translateY(-50%) translateX(-50%) rotate(-225deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(-225deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(-225deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(-225deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(-225deg);
					}
					.slider__item:hover .HovLine1_6 { width:35%; opacity:1; }
					.slider__item:hover .HovLine2_6 { width:35%; opacity:1; }
					.slider__item:hover .HovLine1_7 { top:100%; opacity:1; }
					.slider__item:hover .HovLine2_7 { top:0%; opacity:1; }
					.slider__item:hover .HovLine1_8 { top:100%; opacity:1; }
					.slider__item:hover .HovLine2_8 { top:0%; opacity:1; }
					.slider__item:hover .HovLine1_9 { width:200%; opacity:1; }
					.slider__item:hover .HovLine2_9 { width:200%; opacity:1; }
					.slider__item:hover .HovLine1_10 { width:200%; opacity:1; }
					.slider__item:hover .HovLine2_10 { width:200%; opacity:1; }
					.IconForPopup1
					{
						position:absolute;
						top:50%;
						left:20%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?> !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
					}
					.slider__item:hover .IconForPopup1 { opacity:1; left:38%; }
					.IconForPopup2
					{
						position:absolute;
						top:50%;
						left:80%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?> !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
					}
					.slider__item:hover .IconForPopup2 { opacity:1; left:62%; }
					.IconForPopup3
					{
						position:absolute;
						top:20%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?> !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
					}
					.slider__item:hover .IconForPopup3 { opacity:1; top:38%; }
					.IconForPopup4
					{
						position:absolute;
						top:80%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?> !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
					}
					.slider__item:hover .IconForPopup4 { opacity:1; top:62%; }
					.IconForPopup5
					{
						position:absolute;
						top:50%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?> !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
					}
					.slider__item:hover .IconForPopup5 { opacity:1; left:38%; }
					.IconForPopup6
					{
						position:absolute;
						top:50%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?> !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
					}
					.slider__item:hover .IconForPopup6 { opacity:1; left:62%; }
					.IconForPopup7
					{
						position:absolute;
						top:50%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?> !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
					}
					.slider__item:hover .IconForPopup7 { opacity:1; top:38%; }
					.IconForPopup8
					{
						position:absolute;
						top:50%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?> !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
					}
					.slider__item:hover .IconForPopup8 { opacity:1; top:62%; }
					.IconForPopup9
					{
						position:absolute;
						top:50%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?> !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07/10;?>s linear !important;
					}
					.slider__item:hover .IconForPopup9 { opacity:1; }
					.IconForLink1
					{
						position:absolute;
						top:50%;
						left:80%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?> solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
					}
					.IconForLink1:hover { color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important; }
					.slider__item:hover .IconForLink1 { opacity:1; left:62%; }
					.IconForLink2
					{
						position:absolute;
						top:50%;
						left:20%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?> solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
					}
					.IconForLink2:hover { color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important; }
					.slider__item:hover .IconForLink2 { opacity:1; left:38%; }
					.IconForLink3
					{
						position:absolute;
						top:80%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?> solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
					}
					.IconForLink3:hover { color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important; }
					.slider__item:hover .IconForLink3 { opacity:1; top:62%; }
					.IconForLink4
					{
						position:absolute;
						top:20%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?> solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
					}
					.IconForLink4:hover { color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important; }
					.slider__item:hover .IconForLink4 { opacity:1; top:38%; }
					.IconForLink5
					{
						position:absolute;
						top:50%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?> solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
					}
					.IconForLink5:hover { color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important; }
					.slider__item:hover .IconForLink5 { opacity:1; left:62%; }
					.IconForLink6
					{
						position:absolute;
						top:50%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?> solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
					}
					.IconForLink6:hover { color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important; }
					.slider__item:hover .IconForLink6 { opacity:1; left:38%; }
					.IconForLink7
					{
						position:absolute;
						top:50%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?> solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
					}
					.IconForLink7:hover { color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important; }
					.slider__item:hover .IconForLink7 { opacity:1; top:62%; }
					.IconForLink8
					{
						position:absolute;
						top:50%;
						left:50%;
						font-size:5px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important;
						padding:8px;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?> solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>px !important;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?> !important;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10/10;?>s linear !important;
					}
					.IconForLink8:hover { color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?> !important; }
					.slider__item:hover .IconForLink8 { opacity:1; top:38%; }
					.hoverDivPort1
					{
						position:absolute;
						width:0%;
						height:200%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
					}
					.slider__item:hover .hoverDivPort1 { width:200%; }
					.hoverDivPort2
					{
						position:absolute;
						width:0%;
						height:200%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
					}
					.slider__item:hover .hoverDivPort2 { width:200%; }
					.hoverDivPort3
					{
						position:absolute;
						width:0%;
						height:0%;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
					}
					.slider__item:hover .hoverDivPort3 { width:200%; height:200%; }
					.hoverDivPort4
					{
						position:absolute;
						width:0%;
						height:0%;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
					}
					.slider__item:hover .hoverDivPort4 { width:200%; height:200%; }
					.hoverDivPort5
					{
						position:absolute;
						width:0%;
						height:200%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
					}
					.slider__item:hover .hoverDivPort5 { width:200%; }
					.hoverDivPort6
					{
						position:absolute;
						width:0%;
						height:200%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
					}
					.slider__item:hover .hoverDivPort6 { width:200%; }
					.hoverDivPort7
					{
						position:absolute;
						width:0%;
						height:0%;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
					}
					.slider__item:hover .hoverDivPort7 { width:200%; height:200%; border-radius:0%; }
					.hoverDivPort8
					{
						position:absolute;
						width:0%;
						height:0%;
						border-radius:50%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						top:50%;
						left:50%;
						transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(135deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 1.9, 0.885, -1.310) !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 1.9, 0.885, -1.310) !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 1.9, 0.885, -1.310) !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 1.9, 0.885, -1.310) !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 1.9, 0.885, -1.310) !important;
					}
					.slider__item:hover .hoverDivPort8 { width:200%; height:200%; border-radius:0%; }
					.hoverDivPort9
					{
						position:absolute;
						width:200%;
						height:100%;
						top:0%;
						left:0%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						transform:translateY(100%) rotate(0deg);
						-webkit-transform:translateY(100%) rotate(0deg);
						-ms-transform:translateY(100%) rotate(0deg);
						-moz-transform:translateY(100%) rotate(0deg);
						-o-transform:translateY(100%) rotate(0deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
					}
					.slider__item:hover .hoverDivPort9
					{
						transform:translateY(60%) rotate(-24deg);
						-webkit-transform:translateY(60%) rotate(-24deg);
						-ms-transform:translateY(60%) rotate(-24deg);
						-moz-transform:translateY(60%) rotate(-24deg);
						-o-transform:translateY(60%) rotate(-24deg);
					}
					.hoverDivPort10
					{
						position:absolute;
						width:200%;
						height:100%;
						top:0%;
						left:0%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s linear !important;
					}
					.slider__item:hover .hoverDivPort10 { opacity:0.8; }
					.hoverDivPort11
					{
						position:absolute;
						width:200%;
						height:100%;
						top:0%;
						left:0%;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						opacity:0;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27/10;?>s cubic-bezier( 0.420, 0.9, 0.885, -1.310) !important;
					}
					.slider__item:hover .hoverDivPort11 { opacity:0.8; }
					.hovRound1
					{
						position:absolute;
						width:0%;
						height:0%;
						border:1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
						top:50%;
						left:50%;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
					}
					.slider__item:hover .hovRound1
					{
						width:80%;
						height:80%;
						border:100px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
					}
					.hovRound2
					{
						position:absolute;
						width:0%;
						height:0%;
						border:1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
						top:50%;
						left:50%;
						opacity:0;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -1.3) !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -1.3) !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -1.3) !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -1.3) !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -1.3) !important;
					}
					.slider__item:hover .hovRound2
					{
						width:80%;
						height:80%;
						border:100px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
					}
					.hovRound3
					{
						position:absolute;
						width:0%;
						height:0%;
						border:1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
						top:50%;
						left:50%;
						opacity:0;
						border-radius:50%;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
					}
					.slider__item:hover .hovRound3
					{
						width:40%;
						height:40%;
						border:300px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
					}
					.hovRound4
					{
						position:absolute;
						width:0%;
						height:0%;
						border:1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
						top:50%;
						left:50%;
						opacity:0;
						border-radius:50%;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -0.5) !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -0.5) !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -0.5) !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -0.5) !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -0.5) !important;
					}
					.slider__item:hover .hovRound4
					{
						width:40%;
						height:40%;
						border:300px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
					}
					.hovRound5
					{
						position:absolute;
						width:0%;
						height:0%;
						border:1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
						top:50%;
						left:50%;
						opacity:0;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
					}
					.slider__item:hover .hovRound5
					{
						width:40%;
						height:40%;
						border:300px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
					}
					.hovRound6
					{
						position:absolute;
						width:0%;
						height:0%;
						border:1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
						top:50%;
						left:50%;
						opacity:0;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -0.5) !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -0.5) !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -0.5) !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -0.5) !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -0.5) !important;
					}
					.slider__item:hover .hovRound6
					{
						width:40%;
						height:40%;
						border:300px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
					}
					.hovRound7
					{
						position:absolute;
						width:0%;
						height:0%;
						border:1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
						top:50%;
						left:50%;
						opacity:0;
						transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s linear !important;
					}
					.slider__item:hover .hovRound7
					{
						width:40%;
						height:40%;
						border:300px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
					}
					.hovRound8
					{
						position:absolute;
						width:0%;
						height:0%;
						border:1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
						top:50%;
						left:50%;
						opacity:0;
						transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(0deg);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39/10;?>s cubic-bezier( 0.420, 1.3, 0.885, -0.5) !important;
					}
					.slider__item:hover .hovRound8
					{
						width:40%;
						height:40%;
						border:300px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;
						transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg);
						-o-transform:translateY(-50%) translateX(-50%) rotate(45deg);
					}
					.portIc { cursor:pointer; }
					.portLink { cursor:pointer; box-shadow: none !important; -moz-box-shadow: none !important; -webkit-box-shadow: none !important; }
					.portLink:focus { -moz-box-shadow: none !important; -webkit-box-shadow: none !important; box-shadow: none !important; outline: none !important; }
					.carSliderPort
					{
						position:fixed;
						bottom:0%;
						width:100%;
						left:0%;
						display:none;
						padding-top:5px;
						padding-bottom:5px;
						z-index:999999999 !important;
						text-align:center;
					}
					.carSliderPortRel { position:relative; margin-left:auto; margin-right:auto; }
					.carImgs
					{
						display:inline-block !important;
						position:relative;
						z-index:999999999;
						box-sizing:border-box !important;
						-moz-box-sizing:border-box !important;
						-webkit-box-sizing:border-box !important;
						cursor:pointer;
						margin-left:2px;
						margin-right:2px;
						height:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18;?>px;
					}
					.leftClickPortSl
					{
						position:absolute;
						display:block;
						width:50%;
						height:100%;
						left:0px;
						top:0px;
						cursor:pointer;
					}
					.rightClickPortSl
					{
						position:absolute;
						width:50%;
						display:block;
						height:100%;
						right:0px;
						top:0px;
						cursor:pointer;
					}
					.totLeft
					{
						position: absolute;
						top: 50%;
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_23;?>px;
						transform: translateY(-50%);
						-webkit-transform: translateY(-50%);
						-ms-transform: translateY(-50%);
						-moz-transform: translateY(-50%);
						-o-transform: translateY(-50%);
						left: 2px;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_22;?>;
						display:none;
					}
					.totRight
					{
						position: absolute;
						top: 50%;
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_23;?>px;
						transform: translateY(-50%);
						-webkit-transform: translateY(-50%);
						-ms-transform: translateY(-50%);
						-moz-transform: translateY(-50%);
						-o-transform: translateY(-50%);
						right: 2px;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_22;?>;
						display:none;
					}
					.leftClickPortSl:hover .totLeft { display:block; }
					.rightClickPortSl:hover .totRight { display:block; }
					.caruselLeftClick
					{
						position:absolute;
						left:0px;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
						cursor:pointer;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_29;?>;
						z-index:99999999999;
						display:none;
					}
					.caruselRightClick
					{
						position:absolute;
						right:0px;
						top:50%;
						transform:translateY(-50%);
						-webkit-transform:translateY(-50%);
						-ms-transform:translateY(-50%);
						-moz-transform:translateY(-50%);
						-o-transform:translateY(-50%);
						cursor:pointer;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_29;?>;
						z-index:99999999999;
						display:none;
					}
					.carCl { font-size:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_30;?>px; }
					#jdbpopup_container .jdbpopup_overlay
					{
						position:fixed;
						width:100%;
						height:100%;
						z-index:20000;
						top:0;
						left:0;
						padding:0;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_11;?>
					}
					#jdbpopup_container .jdbpopup_subcontainer
					{
						position:fixed;
						display:block;
						top:50%;
						left:50%;
						height:auto !important;
						width:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_16;?>px !important;
						max-width:95%;
						z-index:999999999999999999999;
						border:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_17;?>px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_20;?>;
						margin-top:auto !important;
						margin-left:auto !important;
						transform:translateY(-50%) translateX(-50%);
						-webkit-transform:translateY(-50%) translateX(-50%);
						-ms-transform:translateY(-50%) translateX(-50%);
						-moz-transform:translateY(-50%) translateX(-50%);
						-o-transform:translateY(-50%) translateX(-50%);
						max-height:80%;
						overflow:hidden;
					}
					.portDelIcPop
					{
						font-size:0px;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_28;?>;
						padding:0px;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_26;?>
					}
					#jdbpopup_container .jdbpopup_subcontainer .jdbpopup_caption.caption_on
					{
						position:absolute;
						display:block;
						width:100%;
						padding:0px 0px;
						left:0;
						bottom:6px;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_35;?>;
						text-align:center;
						line-height:1 !important;
						font-size:0px;
						font-weight:400;
						color:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_34;?>;
						-webkit-backface-visibility:hidden;
						-moz-backface-visibility:hidden;
						-ms-backface-visibility:hidden;
						-o-backface-visibility:hidden;
						backface-visibility:hidden;
						font-family:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_33;?>; 
						text-align: center; 
					}
					.grid<?php echo $Total_Soft_Portfolio; ?>
					{
						position: relative;
						overflow: hidden;
						max-width: 1300px;
						margin: 0 auto;
						padding: 1.5em 0 8em;
						text-align: center;
						-webkit-user-select: none;
						-moz-user-select: none;
						-ms-user-select: none;
						user-select: none;
						-webkit-touch-callout: none;
						-khtml-user-select: none;
					}
					/* Loader */
					.grid__loader { display: none !important; margin: 3em auto 0; }
					.grid<?php echo $Total_Soft_Portfolio; ?>--loading .grid__loader { display: block; }
					/* Clearfix */
					.grid<?php echo $Total_Soft_Portfolio; ?>:after { content: ''; display: block; clear: both; }
					/* grid<?php echo $Total_Soft_Portfolio; ?> items */
					.grid__sizer<?php echo $Total_Soft_Portfolio; ?>, .grid__item<?php echo $Total_Soft_Portfolio; ?> { position: relative; float: left; width: 25%; }
					.grid<?php echo $Total_Soft_Portfolio; ?>--loading .grid__item<?php echo $Total_Soft_Portfolio; ?> { visibility: hidden; }
					.grid__item<?php echo $Total_Soft_Portfolio; ?>--size-a { width: 50%; }
					/* Gallery */
					.slider<?php echo $Total_Soft_Portfolio; ?> { border-radius: 3px; }
					.slider__item { position:relative; width: 100%; overflow:hidden; }
					.slider__item img { width: 100%; vertical-align: middle !important; margin: 0 !important; }
					/* Flickity page dots */
					.slider<?php echo $Total_Soft_Portfolio; ?> .flickity-page-dots
					{
						bottom: 20px;
						opacity: 0;
						-webkit-transition: opacity .3s;
						-ms-transition: opacity .3s;
						-moz-transition: opacity .3s;
						-o-transition: opacity .3s;
						transition: opacity .3s;
					}
					/* Product meta */
					.grid__item<?php echo $Total_Soft_Portfolio; ?> .meta { position: relative; margin: 10px 0 0 !important; padding: 3px 5px 3px 5px !important; }
					.meta__brand { display: block; }
					/* Action style */
					.action 
					{
						position: inherit;
						overflow: hidden;
						margin: 0;
						padding: .25em;
						cursor: pointer;
						border: none;
						line-height: 1 !important;
						background: none;
					}
					.action:focus { outline: none; }
					.no-touch .action--button:hover { outline: none; background:none; }
					.text-hidden { position: absolute; top: 200%; }
					/* Add to cart button */
					.action--buy
					{
						position: absolute;
						top: 0;
						right: 0;
						padding: 1.85em 2.35em;
						-webkit-transition: opacity .3s, -webkit-transform .3s;
						-ms-transition: opacity .3s, -ms-transform .3s;
						-moz-transition: opacity .3s, -moz-transform .3s;
						-o-transition: opacity .3s, -o-transform .3s;
						transition: opacity .3s, transform .3s;
						-webkit-transform: translate3d(-5px, 0, 0);
						-ms-transform: translate3d(-5px, 0, 0);
						-moz-transform: translate3d(-5px, 0, 0);
						-o-transform: translate3d(-5px, 0, 0);
						transform: translate3d(-5px, 0, 0);
					}
					.no-touch .action--buy { opacity: 0; }
					.no-touch .grid__item<?php echo $Total_Soft_Portfolio; ?>:hover .action--buy
					{
						opacity: 1;
						-webkit-transform: translate3d(0, 0, 0);
						-ms-transform: translate3d(0, 0, 0);
						-moz-transform: translate3d(0, 0, 0);
						-o-transform: translate3d(0, 0, 0);
						transform: translate3d(0, 0, 0);
					}
					/* Fixed bottom bar<?php echo $Total_Soft_Portfolio; ?> */
					.bar<?php echo $Total_Soft_Portfolio; ?>
					{
						position: relative;
						z-index: 100;
						bottom: 0;
						left: 0;
						width: 100%;
						padding: 10px;
						-webkit-transform: translate3d(0, 0, 0);
						-ms-transform: translate3d(0, 0, 0);
						-moz-transform: translate3d(0, 0, 0);
						-o-transform: translate3d(0, 0, 0);
						-webkit-box-sizing: border-box;
						-moz-box-sizing: border-box;
						box-sizing: border-box;
						/* Fix for Chrome flicker on Mac ...party like we're in 2012! */
					}
					/* Filter */
					/* Resize grid<?php echo $Total_Soft_Portfolio; ?> items on smaller screens */
					@media screen and (min-width: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_16;?>px)
					{
						#jdbpopup_container .jdbpopup_subcontainer .jdbpopup_caption.caption_on
						{
							font-size:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_32;?>px;
							padding:5px 0px;
						}
						.portDelIcPop { font-size:20px; padding:10px; }
					}
					@media screen and (max-width: 65em)
					{
						.grid__sizer<?php echo $Total_Soft_Portfolio; ?>,
						.grid__item<?php echo $Total_Soft_Portfolio; ?>,
						.grid__item<?php echo $Total_Soft_Portfolio; ?>--size-a { width: 33.333%; }
					}
					@media screen and (max-width: 50em)
					{
						.grid__sizer<?php echo $Total_Soft_Portfolio; ?>,
						.grid__item<?php echo $Total_Soft_Portfolio; ?>,
						.grid__item<?php echo $Total_Soft_Portfolio; ?>--size-a { width: 50%; }
						.bar<?php echo $Total_Soft_Portfolio; ?> { padding-left: 0; text-align: left; }
					}
					@media screen and (max-width: 40em) 
					{
						.bar<?php echo $Total_Soft_Portfolio; ?> { padding: .5em 4.5em .5em 0; }
						.flexbox .filter { -webkit-justify-content: space-around; -moz-justify-content: space-around; justify-content: space-around; }
						.filter__item<?php echo $Total_Soft_Portfolio; ?> { font-weight: bold; margin: 0 2%; padding:0 10px; vertical-align: middle; }
						.action__text { display: none; }
						.cart { padding: 0 1em; }
					}
					@media screen and (max-width: 25em)
					{
						.grid<?php echo $Total_Soft_Portfolio; ?> { max-width: 75%; }
						.grid__loader { margin: 0 auto; }
						.grid__sizer<?php echo $Total_Soft_Portfolio; ?>,
						.grid__item<?php echo $Total_Soft_Portfolio; ?>,
						.grid__item<?php echo $Total_Soft_Portfolio; ?>--size-a { width: 100%; }
					}
					@media screen and (max-width: 820px)
					{
						.carSliderPort { display: none !important; }
						.leftClickPortSl .totLeft { display:block; }
						.rightClickPortSl .totRight { display:block; }
						#jdbpopup_container .jdbpopup_subcontainer { width: auto !important; }
					}
					@media screen and (max-width: 500px)
					{
						.carSliderPort { display: none !important; }
						.gird, .grid<?php echo $Total_Soft_Portfolio; ?> *, .jdbpopup_subcontainer, .jdbpopup_subcontainer * { cursor: default !important; }
						#jdbpopup_container .jdbpopup_subcontainer { width: 95% !important; }
					}
				</style>
				<!-- 1,2,4 -->
				<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "Effect 1" || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "Effect 2" || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "Effect 4" || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "#ffffff" || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19 == "") { ?>
					<div class="bar<?php echo $Total_Soft_Portfolio; ?>">
						<div class="filter">
							<button class="action filter__item<?php echo $Total_Soft_Portfolio; ?> filter__item<?php echo $Total_Soft_Portfolio; ?>--selected" data-filter="*">
								<?php echo html_entity_decode($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01);?>
							</button>
							<?php for($i=0;$i<$TotalSoftPortfolioManager[0]->TotalSoftPortfolio_AlbumCount;$i++) { ?>
								<button class="action filter__item<?php echo $Total_Soft_Portfolio; ?>" data-filter="<?php echo '.' . html_entity_decode($TotalSoftPortfolioAlbums[$i]->id);?>">
									<i class="icon" style='display:none;'></i>
									<?php echo html_entity_decode($TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle); ?>
								</button>
							<?php } ?> 
						</div>
					</div>
				<?php } else { ?>
					<!-- 3,5,6 -->
					<div class="bar<?php echo $Total_Soft_Portfolio; ?>">
						<div class="filter">
							<button class="action filter__item<?php echo $Total_Soft_Portfolio; ?> filter__item<?php echo $Total_Soft_Portfolio; ?>--selected" data-filter="*">
								<span class="tot_hov_span">
									<?php echo html_entity_decode($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01);?>
								</span>
							</button>
							<?php for($i=0;$i<$TotalSoftPortfolioManager[0]->TotalSoftPortfolio_AlbumCount;$i++) { ?>
								<button class="action filter__item<?php echo $Total_Soft_Portfolio; ?>" data-filter="<?php echo '.' . html_entity_decode($TotalSoftPortfolioAlbums[$i]->id);?>">
									<i class="icon" style='display:none;'></i>
									<span class="tot_hov_span">
										<?php echo html_entity_decode($TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle); ?>
									</span>
								</button>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<div class="view">
					<!-- Grid -->
					<section class="grid<?php echo $Total_Soft_Portfolio; ?> grid<?php echo $Total_Soft_Portfolio; ?>--loading">
						<!-- Loader -->
						<img class="grid__loader" src="<?php echo plugins_url('../Images/grid.svg',__FILE__);?>" width="60" alt="Loader image" />
						<!-- Grid sizer for a fluid Isotope (Masonry) layout -->
						<div class="grid__sizer<?php echo $Total_Soft_Portfolio; ?>"></div>
						<!-- Grid items -->
						<?php for($i=0;$i<count($TotalSoftPortfolioImages);$i++){
							$Portfolio_AID=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name5 WHERE TotalSoftPortfolio_ATitle = %s AND Portfolio_ID = %s order by id desc limit 1",$TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IA, $Total_Soft_Portfolio));
							if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05=='true'){
								if($i%6==0){ ?>
									<div class="grid__item<?php echo $Total_Soft_Portfolio; ?> grid__item<?php echo $Total_Soft_Portfolio; ?>--size-a <?php echo $Portfolio_AID[0]->id;?>">
										<div class="slider<?php echo $Total_Soft_Portfolio; ?>">
											<div class="slider__item slider__item<?php echo $i+1; ?>">
												<img class='forZoom' src="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>" alt="Dummy" name='<?php echo $Portfolio_AID[0]->id;?>' />
												<div class='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>'></div>
												<div class='hovL <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>'></div>
												<div class='hovL <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?>'></div>
												<div style='box-sizing:initial;' class='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_38;?>'></div>
												<i href="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>" title="<?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?>" class='jdbpopup <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?> <?php echo $Pop_Ic_Type; ?> portIc portIc<?php echo $i+1; ?>' onclick='carPop<?php echo $Total_Soft_Portfolio; ?>("<?php echo $Portfolio_AID[0]->id;?>",<?php echo $i; ?>,"<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>")'></i>
												<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink!=''){ ?>
													<a href="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink;?>" target="<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IONT == 'true'){ echo '_blank';} ?>" class='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_09;?> totalsoft totalsoft-link portLink portLink<?php echo $i+1; ?>' style='text-decoration:none;'></a>
												<?php } ?>
											</div>
										</div>
										<div class="meta">
											<h3 class="meta__title<?php echo $Total_Soft_Portfolio; ?>" name='<?php echo $Portfolio_AID[0]->id;?>'><?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?></h3>
											<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18=='true'){ ?>
												<span class="meta__brand"><?php echo do_shortcode(html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IDesc));?></span>
											<?php } ?>
										</div>
									</div>
								<?php } else { ?>
									<div class="grid__item<?php echo $Total_Soft_Portfolio; ?> <?php echo $Portfolio_AID[0]->id;?>">
										<div class="slider<?php echo $Total_Soft_Portfolio; ?>">
											<div class="slider__item slider__item<?php echo $i+1; ?>">
												<img class='forZoom' src="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>" alt="Dummy" name='<?php echo $Portfolio_AID[0]->id;?>' />
												<div class='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>'></div>
												<div class='hovL <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>' ></div>
												<div class='hovL <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?>' ></div>
												<div style='box-sizing:initial;' class='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_38;?>'></div>
												<i href="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>" title="<?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?>" class='jdbpopup <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?> <?php echo $Pop_Ic_Type; ?> portIc portIc<?php echo $i+1; ?>' onclick='carPop<?php echo $Total_Soft_Portfolio; ?>("<?php echo $Portfolio_AID[0]->id;?>",<?php echo $i; ?>,"<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>")'></i>
												<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink!=''){ ?>
													<a href="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink;?>" target="<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IONT == 'true'){ echo '_blank';} ?>" class='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_09;?> totalsoft totalsoft-link portLink portLink<?php echo $i+1; ?>' style='text-decoration:none;'></a>
												<?php } ?>
											</div>
										</div>
										<div class="meta">
											<h3 class="meta__title<?php echo $Total_Soft_Portfolio; ?>" name='<?php echo $Portfolio_AID[0]->id;?>'><?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?></h3>
											<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18=='true'){ ?>
												<span class="meta__brand"><?php echo do_shortcode(html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IDesc));?></span>
											<?php } ?>
										</div>
									</div>
							<?php } } else { ?>
								<div class="grid__item<?php echo $Total_Soft_Portfolio; ?> <?php echo $Portfolio_AID[0]->id;?>">
									<div class="slider<?php echo $Total_Soft_Portfolio; ?>">
										<div class="slider__item slider__item<?php echo $i+1; ?>">
											<img class='forZoom' src="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>" alt="Dummy" name='<?php echo $Portfolio_AID[0]->id;?>' />
												<div class='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>'></div>
												<div class='hovL <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>' ></div>
												<div class='hovL <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?>' ></div>
												<div style='box-sizing:initial;' class='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_38;?>'></div>
												<i href="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>" title="<?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?>" class='jdbpopup <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?> <?php echo $Pop_Ic_Type; ?> portIc portIc<?php echo $i+1; ?>' onclick='carPop<?php echo $Total_Soft_Portfolio; ?>("<?php echo $Portfolio_AID[0]->id;?>",<?php echo $i; ?>,"<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>")'></i>
												<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink!=''){ ?>
													<a href="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink;?>" target="<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IONT == 'true'){ echo '_blank';} ?>" class='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_09;?> totalsoft totalsoft-link portLink portLink<?php echo $i+1; ?>' style='text-decoration:none;'></a>
												<?php } ?>
										</div>
									</div>
									<div class="meta">
										<h3 class="meta__title<?php echo $Total_Soft_Portfolio; ?>" name='<?php echo $Portfolio_AID[0]->id;?>'><?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?></h3>
										<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18=='true'){ ?>
											<span class="meta__brand"><?php echo do_shortcode(html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IDesc));?></span>
										<?php } ?>
									</div>
								</div>
						<?php } } ?>
						<input type='text' style='display:none;' class='popIcFS' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>'>
						<input type='text' style='display:none;' class='popStartTime' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_12;?>'>
						<input type='text' style='display:none;' class='popStopTime' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_13;?>'>
						<input type='text' style='display:none;' class='popTimeEffectType' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_14;?>'>
						<input type='text' style='display:none;' class='popEffectType<?php echo $Total_Soft_Portfolio; ?>' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_15;?>'>
						<input type='text' style='display:none;' class='sliderImgWidth' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_16;?>'>
						<input type='text' style='display:none;' class='carsliderImgBordWidth' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_19;?>'>
						<input type='text' style='display:none;' class='carsliderImgBordColor' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_20;?>'>
						<input type='text' style='display:none;' class='SShowPauseTime' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_21;?>'>
						<input type='text' style='display:none;' class='SliderLeftIconType' value='<?php echo $TotalSoft_FG_Slider_Icon_Left; ?>'>
						<input type='text' style='display:none;' class='SliderRightIconType' value='<?php echo $TotalSoft_FG_Slider_Icon_Right; ?>'>
						<input type='text' style='display:none;' class='DelIconType' value='<?php echo $TotalSoft_FG_Slider_Del_Icon_Type; ?>'>
						<input type='text' style='display:none;' class='DelIconSize' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_25;?>'>
						<input type='text' style='display:none;' class='popImgWidth' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_16;?>'>
						<input type='text' style='display:none;' class='CarSliderIconSize' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_30;?>'>
						<input type='text' style='display:none;' class='SliderIconSize' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_23;?>'>
						<input type='text' style='display:none;' class='SliderTitleImgFontSize' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_32;?>'>
						<input type='text' style='display:none;' class='CarSliderIconTypeLeft' value='<?php echo $TotalSoft_FG_Car_Slider_Icon_Left; ?>'>
						<input type='text' style='display:none;' class='CarSliderIconTypeRight' value='<?php echo $TotalSoft_FG_Car_Slider_Icon_Right; ?>'>
						<input type='text' style='display:none;' class='filtItemFSize' value='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>'>
					</section>
					<!-- /grid<?php echo $Total_Soft_Portfolio; ?>-->
				</div>
				<!-- /view -->
				<script>
					jQuery(document).ready(function(){
						var popIcFS = jQuery('.popIcFS').val();
						var DelIconSize = jQuery('.DelIconSize').val();
						var popImgWidth = parseInt(jQuery('.popImgWidth').val());
						var CarSliderIconSize = parseInt(jQuery('.CarSliderIconSize').val());
						var SliderIconSize = parseInt(jQuery('.SliderIconSize').val());
						var SliderTitleImgFontSize = parseInt(jQuery('.SliderTitleImgFontSize').val());
						var filtItemFSize = parseInt(jQuery('.filtItemFSize').val());
						var IcArray = [];
						jQuery('.portIc').each(function(){ IcArray.push(jQuery(this)); })
						function resp()
						{
							for(i=1;i<=IcArray.length;i++)
							{
								jQuery('.portIc'+i).css('font-size',Math.ceil(popIcFS*jQuery('.slider__item'+i).width()/1000));
								jQuery('.portIc'+i).css('padding',Math.ceil(30*jQuery('.slider__item'+i).width()/1000));
								jQuery('.portLink'+i).css('font-size',Math.ceil(popIcFS*jQuery('.slider__item'+i).width()/1000));
								jQuery('.portLink'+i).css('padding',Math.ceil(30*jQuery('.slider__item'+i).width()/1000));
							}
							jQuery('.filter__item<?php echo $Total_Soft_Portfolio; ?>').css('font-size',Math.ceil(filtItemFSize*jQuery('.filtItemFSize').parent().parent().width()/(jQuery('.filtItemFSize').parent().parent().width()+200)));
							if(jQuery(window).width()<=popImgWidth)
							{
								jQuery('.portDelIcPop').css('font-size',Math.ceil(DelIconSize*jQuery(window).width()/popImgWidth));
								jQuery('.portDelIcPop').css('padding',Math.ceil(5*jQuery(window).width()/popImgWidth));
								jQuery('.carCl').css('font-size',Math.ceil(CarSliderIconSize*jQuery(window).width()/popImgWidth));
								jQuery('.totLeft').css('font-size',Math.ceil(SliderIconSize*jQuery(window).width()/popImgWidth));
								jQuery('.totRight').css('font-size',Math.ceil(SliderIconSize*jQuery(window).width()/popImgWidth));
								jQuery('#jdbpopup_container .jdbpopup_subcontainer .jdbpopup_caption.caption_on').css('font-size',Math.ceil(SliderTitleImgFontSize*jQuery(window).width()/popImgWidth));
								jQuery('#jdbpopup_container .jdbpopup_subcontainer .jdbpopup_caption.caption_on').css('padding','5px 0px');
							}
							else
							{
								jQuery('#jdbpopup_container .jdbpopup_subcontainer .jdbpopup_caption.caption_on').css('font-size',SliderTitleImgFontSize+'px');
								jQuery('#jdbpopup_container .jdbpopup_subcontainer .jdbpopup_caption.caption_on').css('padding','5px 0px');
							}
						}
						if (!jQuery('.filtItemFSize').parent().parent().width()) { setTimeout(function(){ resp(); },100) }
						else { jQuery(window).load(function(){ resp(); }); resp(); }
						jQuery(window).resize(function(){ resp(); })
					})
					var carsliderImgBordWidth = parseInt(jQuery('.carsliderImgBordWidth').val());
					var carsliderImgBordColor = jQuery('.carsliderImgBordColor').val();
					var carsliderImgBordStyle = 'solid';
					var SShow = 'true';
					var SShowPauseTime = parseInt(jQuery('.SShowPauseTime').val());
					var CarSliderIconTypeLeft = jQuery('.CarSliderIconTypeLeft').val();
					var CarSliderIconTypeRight = jQuery('.CarSliderIconTypeRight').val();
					var clArray=[];
					var titArray=[];
					var clNumber=[];
					var width=0;
					var count = 0;
					var left_left=0;
					var win_width=jQuery(window).width();
					var z;
					function carPop<?php echo $Total_Soft_Portfolio; ?>(cl,number,srcc)
					{
						jQuery('body').append("<div class='carSliderPort' onmouseover='stop()' onmouseout='start()'><div class='carSliderPortRel'></div><i class='caruselLeftClick carCl "+CarSliderIconTypeLeft+"' onclick='carusClLeft()'></i><i class='caruselRightClick carCl "+CarSliderIconTypeRight+"' onclick='carusClRight()'></i></div>");
						jQuery('.carSliderPort').show(1000);
						jQuery('.forZoom').each(function(){ if(jQuery(this).attr('name')==cl){ clArray.push(jQuery(this).attr('src')); } })
						jQuery('.meta__title<?php echo $Total_Soft_Portfolio; ?>').each(function(){ if(jQuery(this).attr('name')==cl){ titArray.push(jQuery(this).text()); } })
						var bigSrc = jQuery('#jdbpopup_container .jdbpopup_subcontainer img').attr('src');
						for(i=0;i<=clArray.length-1;i++)
						{
							jQuery('.carSliderPortRel').append("<img style='max-width:none;' src='"+clArray[i]+"' onclick=\"(sr('"+clArray[i]+"',"+i+"))\" class='carImgs carImgs"+i+"' />");
							width += jQuery('.carImgs'+i).width()+carsliderImgBordWidth+5;
							if(jQuery('.carImgs'+i).attr('src')==srcc)
							{
								jQuery('.carImgs'+i).css('border',''+carsliderImgBordWidth+'px '+carsliderImgBordStyle+' '+carsliderImgBordColor+'');
								count = i;
							}
						}
						jQuery('.carSliderPortRel').css('width',width);
						if(jQuery(window).width()<=width){ jQuery('.carCl').css('display','block'); }
						if(jQuery('.carImgs'+count).offset().left+jQuery('.carImgs'+count).width()>win_width)
						{
							jQuery('.carSliderPortRel').animate({'left':'-='+(jQuery('.carImgs'+count).offset().left-(win_width-jQuery('.carImgs'+count).width()))+'px'},500);
							left_left=left_left-(jQuery('.carImgs'+count).offset().left-(win_width-jQuery('.carImgs'+count).width()));
						}
						else if(jQuery('.carImgs'+count).offset().left<0) { jQuery('.carSliderPortRel').animate({'left':'0',},500); left_left=0; }
						if(clArray.length>0 ){ if(SShow == 'true') { z=setInterval(function(){ y=false; changeImgs(); },SShowPauseTime*1000) } }else{ clearInterval(z); }
						jQuery("body").keydown(function(event){
							if(event.which == 27)
							{
								jQuery('#jdbpopup_container').remove();
								closeClick();
							}
							else if(event.which == 37)
							{
								lCl();
							}
							else if(event.which == 39)
							{
								rCl();
							}
						});
					}
					function stop(){ clearInterval(z); }
					function start(){ if(clArray.length>0) { z=setInterval(function(){ y=false; changeImgs(); },SShowPauseTime*1000) }else{ clearInterval(z); } }
					var y=false;
					function changeImgs(){
						if(y==true){ return }
						count++;
						if(count==clArray.length){ count=0; }
						jQuery('.jdbpopup_subcontainer').hide(500);
						jQuery('.carImgs').css('border','none')
						jQuery('.carImgs'+count).css('border',''+carsliderImgBordWidth+'px '+carsliderImgBordStyle+' '+carsliderImgBordColor+'');
						y=true;
						setTimeout(function(){
							jQuery('#jdbpopup_container .jdbpopup_subcontainer img').attr('src',clArray[count]);
							jQuery('.jdbpopup_caption').text(titArray[count]);
							jQuery('.jdbpopup_subcontainer').show(500);
						},500)
						setTimeout(function(){ y=false; },1000)
						if(jQuery('.carImgs'+count).offset().left+jQuery('.carImgs'+count).width()>win_width)
						{
							jQuery('.carSliderPortRel').animate({'left':'-='+(jQuery('.carImgs'+count).offset().left-(win_width-jQuery('.carImgs'+count).width()))+'px'},500);
							left_left=left_left-(jQuery('.carImgs'+count).offset().left-(win_width-jQuery('.carImgs'+count).width()));
						}
						else if(jQuery('.carImgs'+count).offset().left<0)
						{
							jQuery('.carSliderPortRel').animate({'left':'-='+jQuery('.carImgs'+count).offset().left,},500);
							left_left=left_left-jQuery('.carImgs'+count).offset().left;
						}
					}
					function rCl() { changeImgs(); }
					function lCl(){
						count--;
						if(count==-1){ count=clArray.length-1; }
						jQuery('.jdbpopup_subcontainer').hide(500);
						jQuery('.carImgs').css('border','none')
						jQuery('.carImgs'+count).css('border',''+carsliderImgBordWidth+'px '+carsliderImgBordStyle+' '+carsliderImgBordColor+'');
						setTimeout(function(){
							jQuery('#jdbpopup_container .jdbpopup_subcontainer img').attr('src',clArray[count]);
							jQuery('.jdbpopup_caption').text(titArray[count]);
							jQuery('.jdbpopup_subcontainer').show(500);
						},500)
						if(jQuery('.carImgs'+count).offset().left+jQuery('.carImgs'+count).width()>win_width)
						{
							jQuery('.carSliderPortRel').animate({'left':'-='+(jQuery('.carImgs'+count).offset().left-(win_width-jQuery('.carImgs'+count).width()))+'px'},500);
							left_left=left_left-(jQuery('.carImgs'+count).offset().left-(win_width-jQuery('.carImgs'+count).width()));
						}
						else if(jQuery('.carImgs'+count).offset().left<0)
						{
							jQuery('.carSliderPortRel').animate({'left':'-='+jQuery('.carImgs'+count).offset().left,},500);
							left_left=left_left-jQuery('.carImgs'+count).offset().left;
						}
					}
					function sr(src,j){
						if(y==true){ return; }
						y=true;
						count=j;
						jQuery('.jdbpopup_subcontainer').hide(500);
						jQuery('.carImgs').css('border','none')
						jQuery('.carImgs'+count).css('border',''+carsliderImgBordWidth+'px '+carsliderImgBordStyle+' '+carsliderImgBordColor+'');
						setTimeout(function(){
							jQuery('#jdbpopup_container .jdbpopup_subcontainer img').attr('src',src);
							jQuery('.jdbpopup_caption').text(titArray[count]);
							jQuery('.jdbpopup_subcontainer').show(500);
						},500)
						setTimeout(function(){ y=false; },1000)
					}
					function resp(){ if(jQuery(window).width()<=width){ jQuery('.carCl').css('display','block'); } }
					resp();
					jQuery(window).resize(function(){ resp(); })
					function carRight(){
						if(win_width-jQuery('.carSliderPortRel').width()>=left_left){ left_left=0; jQuery('.carSliderPortRel').animate({'left':'0px'},500); }
						else{ left_left = left_left-60; jQuery('.carSliderPortRel').animate({'left':'-=60px'},500); }
					}
					function carLeft(){
						if(jQuery('.carSliderPortRel').offset().left>=0)
						{
							left_left=win_width-jQuery('.carSliderPortRel').width();
							jQuery('.carSliderPortRel').animate({'left':win_width-jQuery('.carSliderPortRel').width()+'px'},500);
						}
						else
						{
							left_left=left_left+60;
							jQuery('.carSliderPortRel').animate({'left':'+=60px'},500);
						}
					}
					function carusClRight(){ carRight(); }
					function carusClLeft(){ carLeft(); }
					function closeClick(){
						clearInterval(z);
						jQuery('.carSliderPort').hide(500);
						jQuery('.carImgs').remove();
						clArray=[];
						jQuery('.carCl').css('display','none');
						jQuery('.carSliderPortRel').css('left','0');
						left_left=0;
						width=0;
					}
				</script>
				<script src="<?php echo plugins_url('../JS/isotope.pkgd.min.js',__FILE__);?>"></script>
				<script src="<?php echo plugins_url('../JS/flickity.pkgd.min.js',__FILE__);?>"></script>
				<script src="<?php echo plugins_url('../JS/modernizr.custom.js',__FILE__);?>"></script>
				<script type="text/javascript">
					;(function(window) {
						'use strict';
						var support = { animations : Modernizr.cssanimations },
							animEndEventNames = { 'WebkitAnimation' : 'webkitAnimationEnd', 'OAnimation' : 'oAnimationEnd', 'msAnimation' : 'MSAnimationEnd', 'animation' : 'animationend' },
							animEndEventName = animEndEventNames[ Modernizr.prefixed( 'animation' ) ],
							onEndAnimation = function( el, callback ) {
								var onEndCallbackFn = function( ev ) {
									if( support.animations ) { if( ev.target != this ) return; this.removeEventListener( animEndEventName, onEndCallbackFn ); }
									if( callback && typeof callback === 'function' ) { callback.call(); }
								};
								if( support.animations ) { el.addEventListener( animEndEventName, onEndCallbackFn ); } else { onEndCallbackFn(); }
							};
						// from http://www.sberry.me/articles/javascript-event-throttling-debouncing
						function throttle(fn, delay) {
							var allowSample = true;
							return function(e) {
								if (allowSample) { allowSample = false; setTimeout(function() { allowSample = true; }, delay); fn(e); }
							};
						}
						// sliders - flickity
						var sliders = [].slice.call(document.querySelectorAll('.slider<?php echo $Total_Soft_Portfolio; ?>')),
							// array where the flickity instances are going to be stored
							flkties = [],
							// grid<?php echo $Total_Soft_Portfolio; ?> element
							grid<?php echo $Total_Soft_Portfolio; ?> = document.querySelector('.grid<?php echo $Total_Soft_Portfolio; ?>'),
							// isotope instance
							iso,
							// filter ctrls
							filterCtrls = [].slice.call(document.querySelectorAll('.filter > button'));
						function init<?php echo $Total_Soft_Portfolio;?>() {
							// preload images
							imagesLoaded(grid<?php echo $Total_Soft_Portfolio; ?>, function() {
								initIsotope();
								initEvents();
								classie.remove(grid<?php echo $Total_Soft_Portfolio; ?>, 'grid<?php echo $Total_Soft_Portfolio; ?>--loading');
							});
						}
						function initIsotope() {
							iso = new Isotope( grid<?php echo $Total_Soft_Portfolio; ?>, {
								isResizeBound: false,
								itemSelector: '.grid__item<?php echo $Total_Soft_Portfolio; ?>',
								percentPosition: true,
								masonry: {
									// use outer width of grid<?php echo $Total_Soft_Portfolio; ?>-sizer for columnWidth
									columnWidth: '.grid__sizer<?php echo $Total_Soft_Portfolio; ?>'
								},
								transitionDuration: '1s'
							});
						}
						function initEvents() {
							filterCtrls.forEach(function(filterCtrl) {
								filterCtrl.addEventListener('click', function() {
									classie.remove(filterCtrl.parentNode.querySelector('.filter__item<?php echo $Total_Soft_Portfolio; ?>--selected'), 'filter__item<?php echo $Total_Soft_Portfolio; ?>--selected');
									classie.add(filterCtrl, 'filter__item<?php echo $Total_Soft_Portfolio; ?>--selected');
									iso.arrange({
										filter: filterCtrl.getAttribute('data-filter')
									});
									recalcFlickities();
									iso.layout();
								});
							});
							window.addEventListener('resize', throttle(function(ev) {
								recalcFlickities()
								iso.layout();
							}, 50));
						}
						function recalcFlickities() { for(var i = 0, len = flkties.length; i < len; ++i) { flkties[i].resize(); } }
						init<?php echo $Total_Soft_Portfolio;?>();
					})(window);
				</script>
				<script type="text/javascript">
					var popStartTime = 100*parseInt(jQuery('.popStartTime').val());
					var popStopTime = 100*parseInt(jQuery('.popStopTime').val());
					var popTimeEffectType = jQuery('.popTimeEffectType').val();
					var DelIconSize = jQuery('.DelIconSize').val();
					var SliderLeftIconType = jQuery('.SliderLeftIconType').val();
					var SliderRightIconType = jQuery('.SliderRightIconType').val();
					var DelIconType = jQuery('.DelIconType').val();
					var popImgWidth = parseInt(jQuery('.popImgWidth').val());
					var CarSliderIconSize = parseInt(jQuery('.CarSliderIconSize').val());
					var SliderIconSize = parseInt(jQuery('.SliderIconSize').val());
					var SliderTitleImgFontSize = parseInt(jQuery('.SliderTitleImgFontSize').val());
					function checkClassJdbpopup<?php echo $Total_Soft_Portfolio; ?>(){var t=jQuery(document.body);t.find(".jdbpopup").each(function(){jQuery(this).jdbpopup()})}!function(t,e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports?module.exports=e(require("jquery")):e(t.jQuery)}(this,function(t){function e(t){if(t in d.style)return t;for(var e=["Moz","Webkit","O","ms"],n=t.charAt(0).toUpperCase()+t.substr(1),i=0;i<e.length;++i){var a=e[i]+n;if(a in d.style)return a}}function n(){return d.style[l.transform]="",d.style[l.transform]="rotateY(90deg)",""!==d.style[l.transform]}function i(t){return"string"==typeof t&&this.parse(t),this}function a(t,e,n){e===!0?t.queue(n):e?t.queue(e,n):t.each(function(){n.call(this)})}function s(e){var n=[];return t.each(e,function(e){e=t.camelCase(e),e=t.transit.propertyMap[e]||t.cssProps[e]||e,e=r(e),l[e]&&(e=r(l[e])),-1===t.inArray(e,n)&&n.push(e)}),n}function o(e,n,i,a){var o=s(e);t.cssEase[i]&&(i=t.cssEase[i]);var p=""+c(n)+" "+i;parseInt(a,10)>0&&(p+=" "+c(a));var r=[];return t.each(o,function(t,e){r.push(e+" "+p)}),r.join(", ")}function p(e,n){n||(t.cssNumber[e]=!0),t.transit.propertyMap[e]=l.transform,t.cssHooks[e]={get:function(n){var i=t(n).css("transit:transform");return i.get(e)},set:function(n,i){var a=t(n).css("transit:transform");a.setFromString(e,i),t(n).css({"transit:transform":a})}}}function r(t){return t.replace(/([A-Z])/g,function(t){return"-"+t.toLowerCase()})}function u(t,e){return"string"!=typeof t||t.match(/^[\-0-9\.]+$/)?""+t+e:t}function c(e){var n=e;return"string"!=typeof n||n.match(/^[\-0-9\.]+/)||(n=t.fx.speeds[n]||t.fx.speeds._default),u(n,"ms")}t.transit={version:"0.9.12",propertyMap:{marginLeft:"margin",marginRight:"margin",marginBottom:"margin",marginTop:"margin",paddingLeft:"padding",paddingRight:"padding",paddingBottom:"padding",paddingTop:"padding"},enabled:!0,useTransitionEnd:!1};var d=document.createElement("div"),l={},f=navigator.userAgent.toLowerCase().indexOf("chrome")>-1;l.transition=e("transition"),l.transitionDelay=e("transitionDelay"),l.transform=e("transform"),l.transformOrigin=e("transformOrigin"),l.filter=e("Filter"),l.transform3d=n();var b={transition:"transitionend",MozTransition:"transitionend",OTransition:"oTransitionEnd",WebkitTransition:"webkitTransitionEnd",msTransition:"MSTransitionEnd"},h=l.transitionEnd=b[l.transition]||null;for(var g in l)l.hasOwnProperty(g)&&"undefined"==typeof t.support[g]&&(t.support[g]=l[g]);return d=null,t.cssEase={_default:"ease","in":"ease-in",out:"ease-out","in-out":"ease-in-out",snap:"cubic-bezier(0,1,.5,1)",easeInCubic:"cubic-bezier(.550,.055,.675,.190)",easeOutCubic:"cubic-bezier(.215,.61,.355,1)",easeInOutCubic:"cubic-bezier(.645,.045,.355,1)",easeInCirc:"cubic-bezier(.6,.04,.98,.335)",easeOutCirc:"cubic-bezier(.075,.82,.165,1)",easeInOutCirc:"cubic-bezier(.785,.135,.15,.86)",easeInExpo:"cubic-bezier(.95,.05,.795,.035)",easeOutExpo:"cubic-bezier(.19,1,.22,1)",easeInOutExpo:"cubic-bezier(1,0,0,1)",easeInQuad:"cubic-bezier(.55,.085,.68,.53)",easeOutQuad:"cubic-bezier(.25,.46,.45,.94)",easeInOutQuad:"cubic-bezier(.455,.03,.515,.955)",easeInQuart:"cubic-bezier(.895,.03,.685,.22)",easeOutQuart:"cubic-bezier(.165,.84,.44,1)",easeInOutQuart:"cubic-bezier(.77,0,.175,1)",easeInQuint:"cubic-bezier(.755,.05,.855,.06)",easeOutQuint:"cubic-bezier(.23,1,.32,1)",easeInOutQuint:"cubic-bezier(.86,0,.07,1)",easeInSine:"cubic-bezier(.47,0,.745,.715)",easeOutSine:"cubic-bezier(.39,.575,.565,1)",easeInOutSine:"cubic-bezier(.445,.05,.55,.95)",easeInBack:"cubic-bezier(.6,-.28,.735,.045)",easeOutBack:"cubic-bezier(.175, .885,.32,1.275)",easeInOutBack:"cubic-bezier(.68,-.55,.265,1.55)"},t.cssHooks["transit:transform"]={get:function(e){return t(e).data("transform")||new i},set:function(e,n){var a=n;a instanceof i||(a=new i(a)),e.style[l.transform]="WebkitTransform"!==l.transform||f?a.toString():a.toString(!0),t(e).data("transform",a)}},t.cssHooks.transform={set:t.cssHooks["transit:transform"].set},t.cssHooks.filter={get:function(t){return t.style[l.filter]},set:function(t,e){t.style[l.filter]=e}},t.fn.jquery<"1.8"&&(t.cssHooks.transformOrigin={get:function(t){return t.style[l.transformOrigin]},set:function(t,e){t.style[l.transformOrigin]=e}},t.cssHooks.transition={get:function(t){return t.style[l.transition]},set:function(t,e){t.style[l.transition]=e}}),p("scale"),p("scaleX"),p("scaleY"),p("translate"),p("rotate"),p("rotateX"),p("rotateY"),p("rotate3d"),p("perspective"),p("skewX"),p("skewY"),p("x",!0),p("y",!0),i.prototype={setFromString:function(t,e){var n="string"==typeof e?e.split(","):e.constructor===Array?e:[e];n.unshift(t),i.prototype.set.apply(this,n)},set:function(t){var e=Array.prototype.slice.apply(arguments,[1]);this.setter[t]?this.setter[t].apply(this,e):this[t]=e.join(",")},get:function(t){return this.getter[t]?this.getter[t].apply(this):this[t]||0},setter:{rotate:function(t){this.rotate=u(t,"deg")},rotateX:function(t){this.rotateX=u(t,"deg")},rotateY:function(t){this.rotateY=u(t,"deg")},scale:function(t,e){void 0===e&&(e=t),this.scale=t+","+e},skewX:function(t){this.skewX=u(t,"deg")},skewY:function(t){this.skewY=u(t,"deg")},perspective:function(t){this.perspective=u(t,"px")},x:function(t){this.set("translate",t,null)},y:function(t){this.set("translate",null,t)},translate:function(t,e){void 0===this._translateX&&(this._translateX=0),void 0===this._translateY&&(this._translateY=0),null!==t&&void 0!==t&&(this._translateX=u(t,"px")),null!==e&&void 0!==e&&(this._translateY=u(e,"px")),this.translate=this._translateX+","+this._translateY}},getter:{x:function(){return this._translateX||0},y:function(){return this._translateY||0},scale:function(){var t=(this.scale||"1,1").split(",");return t[0]&&(t[0]=parseFloat(t[0])),t[1]&&(t[1]=parseFloat(t[1])),t[0]===t[1]?t[0]:t},rotate3d:function(){for(var t=(this.rotate3d||"0,0,0,0deg").split(","),e=0;3>=e;++e)t[e]&&(t[e]=parseFloat(t[e]));return t[3]&&(t[3]=u(t[3],"deg")),t}},parse:function(t){var e=this;t.replace(/([a-zA-Z0-9]+)\((.*?)\)/g,function(t,n,i){e.setFromString(n,i)})},toString:function(t){var e=[];for(var n in this)if(this.hasOwnProperty(n)){if(!l.transform3d&&("rotateX"===n||"rotateY"===n||"perspective"===n||"transformOrigin"===n))continue;"_"!==n[0]&&e.push(t&&"scale"===n?n+"3d("+this[n]+",1)":t&&"translate"===n?n+"3d("+this[n]+",0)":n+"("+this[n]+")")}return e.join(" ")}},t.fn.transition=t.fn.transit=function(e,n,i,s){var p=this,r=0,u=!0,d=t.extend(!0,{},e);"function"==typeof n&&(s=n,n=void 0),"object"==typeof n&&(i=n.easing,r=n.delay||0,u="undefined"==typeof n.queue?!0:n.queue,s=n.complete,n=n.duration),"function"==typeof i&&(s=i,i=void 0),"undefined"!=typeof d.easing&&(i=d.easing,delete d.easing),"undefined"!=typeof d.duration&&(n=d.duration,delete d.duration),"undefined"!=typeof d.complete&&(s=d.complete,delete d.complete),"undefined"!=typeof d.queue&&(u=d.queue,delete d.queue),"undefined"!=typeof d.delay&&(r=d.delay,delete d.delay),"undefined"==typeof n&&(n=t.fx.speeds._default),"undefined"==typeof i&&(i=t.cssEase._default),n=c(n);var f=o(d,n,i,r),b=t.transit.enabled&&l.transition,g=b?parseInt(n,10)+parseInt(r,10):0;if(0===g){var _=function(t){p.css(d),s&&s.apply(p),t&&t()};return a(p,u,_),p}var v={},m=function(e){var n=!1,i=function(){n&&p.unbind(h,i),g>0&&p.each(function(){this.style[l.transition]=v[this]||null}),"function"==typeof s&&s.apply(p),"function"==typeof e&&e()};g>0&&h&&t.transit.useTransitionEnd?(n=!0,p.bind(h,i)):window.setTimeout(i,g),p.each(function(){g>0&&(this.style[l.transition]=f),t(this).css(d)})},j=function(t){this.offsetWidth,m(t)};return a(p,u,j),this},t.transit.getTransitionValue=o,t}),function(t){t.fn.jdbpopup=function(e){function n(t){var e=/^\d+$/;return e.test(t)}function a(e,n){return-1!==t.inArray(n,e)?!0:!1}return jdbpopup_init={init<?php echo $Total_Soft_Portfolio;?>:function(t,e){var n=!1;t.jdbpopup_values&&(n=!0),jdbpopup_init.lists_properties(),jdbpopup_init.resetsjdbpopup_Values(),jdbpopup_init.setjdbpopup_Values(e),t.jdbpopup_values=jdbpopup_init.jdbpopup_values,n||jdbpopup_popup.init<?php echo $Total_Soft_Portfolio;?>(e)},lists_properties:function(){var t=jdbpopup_init;t.list_caption=[!0,!1],t.list_responsive=[!0,!1],t.list_effects<?php echo $Total_Soft_Portfolio; ?>=["fade","scaleIn","scaleOut","flipX","flipY","slide","translateLeft","translateRight","translateTop","translateBottom","translateTopLeft","translateTopRight","translateBottomLeft","translateBottomRight"],t.list_easing=["linear","ease","in","out","in-out","snap","easeOutCubic","easeInOutCubic","easeInCirc","easeOutCirc","easeInOutCirc","easeInExpo","easeOutExpo","easeInOutExpo","easeInQuad","easeOutQuad","easeInOutQuad","easeInQuart","easeOutQuart","easeInOutQuart","easeInQuint","easeOutQuint","easeInOutQuint","easeInSine","easeOutSine","easeInOutSine","easeInBack","easeOutBack","easeInOutBack"]},resetsjdbpopup_Values:function(){var popEffectType<?php echo $Total_Soft_Portfolio; ?> = jQuery('.popEffectType<?php echo $Total_Soft_Portfolio; ?>').val();var t={timeOpen:popStartTime,timeClose:popStopTime,easing:popTimeEffectType,effect<?php echo $Total_Soft_Portfolio; ?>:popEffectType<?php echo $Total_Soft_Portfolio; ?>,caption:!0,responsive:!0,width:200,height:200,imageSource:"",textCaption:""};return jdbpopup_init.jdbpopup_values=t,t},setjdbpopup_Values:function(s){var o<?php echo $Total_Soft_Portfolio; ?>=jdbpopup_init;for(i in e){var p=e[i];"timeOpen"===i&&n(p)&&(o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.timeOpen=p),"timeClose"===i&&n(p)&&(o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.timeClose=p),"caption"===i&&a(o<?php echo $Total_Soft_Portfolio; ?>.list_caption,p)&&(o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.caption=p),"responsive"===i&&a(o<?php echo $Total_Soft_Portfolio; ?>.list_responsive,p)&&(o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.responsive=p),"easing"===i&&a(o<?php echo $Total_Soft_Portfolio; ?>.list_easing,p)&&(o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.easing=p),"effect<?php echo $Total_Soft_Portfolio; ?>"===i&&a(o<?php echo $Total_Soft_Portfolio; ?>.list_effects<?php echo $Total_Soft_Portfolio; ?>,p)&&(o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.effect<?php echo $Total_Soft_Portfolio; ?>=p)}o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.caption&&(o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.textCaption=s.attr("title"),s.attr("data-caption")&&(o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.textCaption=s.attr("data-caption"))),s.attr("href")&&(o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.imageSource=s.attr("href")),s.attr("data-image")&&(o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.imageSource=s.attr("data-image")),t("<img/>").attr("src",o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.imageSource).load(function(){o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.width=this.width,o<?php echo $Total_Soft_Portfolio; ?>.jdbpopup_values.height=this.height})}},jdbpopup_popup={init<?php echo $Total_Soft_Portfolio;?>:function(t){jdbpopup_popup.creationPopup(),t.off("jdbpopup_popup.clickPopup").on("click",jdbpopup_popup.clickPopup)},creationPopup:function(){var e=jdbpopup_template,n=t(document.body);n.find("#jdbpopup_container")&&t("#jdbpopup_container").remove(),n.append(e.popup_container())},clickPopup:function(){var e=this,n=e.jdbpopup_values.imageSource;return jdbpopup_popup.creationPopup(),t("<img/>").attr("src",n).load(function(){e.jdbpopup_values.width=this.width,e.jdbpopup_values.height=this.height,jdbpopup_init.jdbpopup_values=e.jdbpopup_values,jdbpopup_popup.openPopup()}),!1},openPopup:function(){var e=jdbpopup_init.jdbpopup_values,n=t("#jdbpopup_container .jdbpopup_subcontainer");n.css({width:e.width+"px",height:e.height+"px",marginTop:-e.height/2+"px",marginLeft:-e.width/2+"px"}),e.caption&&n.find(".jdbpopup_caption").addClass("caption_on").html(e.textCaption),n.find("img").attr({src:e.imageSource,alt:e.textCaption}),jdbpopup_popup.resizePopup(),jdbpopup_animation.init<?php echo $Total_Soft_Portfolio;?>("open")},closePopup:function(){jdbpopup_init.jdbpopup_values,t("#jdbpopup_container");return jdbpopup_animation.init<?php echo $Total_Soft_Portfolio;?>("close"),!1},resizePopup:function(){function e(t,e,n,a){var s=a/n,o<?php echo $Total_Soft_Portfolio; ?>=80;n>=t?(n=t,a=n*s,a>=e&&(a=e,n=a/s)):a>=e&&(a=e,n=a/s),i.css({width:n-o<?php echo $Total_Soft_Portfolio; ?>+"px",height:a-o<?php echo $Total_Soft_Portfolio; ?>+"px",marginTop:-(a-o<?php echo $Total_Soft_Portfolio; ?>)/2+"px",marginLeft:-(n-o<?php echo $Total_Soft_Portfolio; ?>)/2+"px"})}var n=jdbpopup_init.jdbpopup_values,i=t("#jdbpopup_container .jdbpopup_subcontainer"),a=t(window).width()-50,s=t(window).height()-50;n.responsive&&e(a,s,n.width,n.height)}},jdbpopup_animation={init<?php echo $Total_Soft_Portfolio;?>:function(e){function n(){setTimeout(function(){jdbpopup_popup.resizePopup(),s.off(".jdbpopup_close").on("click",".jdbpopup_close",jdbpopup_popup.closePopup),t(window).off("jdbpopup_popup.resizePopup").on("resize",jdbpopup_popup.resizePopup),jdbpopup_template.resetScroll(!1)},u)}function i(){setTimeout(function(){s.remove(),jdbpopup_template.resetScroll(!0)},u)}var a=jdbpopup_animation,s=t("#jdbpopup_container"),o<?php echo $Total_Soft_Portfolio; ?>=jdbpopup_init.jdbpopup_values,p=o<?php echo $Total_Soft_Portfolio; ?>.effect<?php echo $Total_Soft_Portfolio; ?>,r=o<?php echo $Total_Soft_Portfolio; ?>.easing,u=o<?php echo $Total_Soft_Portfolio; ?>.timeOpen,c=t(window).width(),d=t(window).height();switch(s.css("display","block"),"open"===e?(a.initTransition(s,p),u=o<?php echo $Total_Soft_Portfolio; ?>.timeOpen,a.transitionOverlay(s,1,u,r)):(u=o<?php echo $Total_Soft_Portfolio; ?>.timeClose,a.transitionOverlay(s,0,u,r)),p){case"fade":"open"===e?a.transitionOpacity(s,1,u,r):a.transitionOpacity(s,0,u,r);a.transitionTranslateXY(s,"-50%","-50%",u,r);break;case"scaleIn":"open"===e?a.transitionScale(s,1,1,1,u,r):a.transitionScale(s,0,0,0,u,r);a.transitionTranslateXY(s,"-50%","-50%",u,r);break;case"scaleOut":"open"===e?a.transitionScale(s,1,1,1,u,r):a.transitionScale(s,1.5,1.5,0,u,r);a.transitionTranslateXY(s,"-50%","-50%",u,r);break;case"flipX":"open"===e?a.transitionFlip(s,0,1,1,u,r):a.transitionFlip(s,180,0,0,u,r);a.transitionTranslateXY(s,"-50%","-50%",u,r);break;case"flipY":"open"===e?a.transitionFlip(s,0,0,1,u,r):a.transitionFlip(s,0,180,0,u,r);a.transitionTranslateXY(s,"-50%","-50%",u,r);break;case"slide":"open"===e?a.transitionScale(s,1,1,u,r):a.transitionScale(s,1,0,u,r);a.transitionTranslateXY(s,"-50%","-50%",u,r);break;case"translateLeft":"open"===e?a.transitionTranslateXY(s,"-50%","-50%",u,r):a.transitionTranslateXY(s,-c+"px","0%",u,r);break;case"translateRight":"open"===e?a.transitionTranslateXY(s,"-50%","-50%",u,r):a.transitionTranslateXY(s,c+"px","0%",u,r);break;case"translateTop":"open"===e?a.transitionTranslateXY(s,"-50%","-50%",u,r):a.transitionTranslateXY(s,"0%",-d+"px",u,r);break;case"translateBottom":"open"===e?a.transitionTranslateXY(s,"-50%","-50%",u,r):a.transitionTranslateXY(s,"0%",d+"px",u,r);break;case"translateTopLeft":"open"===e?a.transitionTranslateXY(s,"-50%","-50%",u,r):a.transitionTranslateXY(s,-c+"px",-d+"px",u,r);break;case"translateTopRight":"open"===e?a.transitionTranslateXY(s,"-50%","-50%",u,r):a.transitionTranslateXY(s,c+"px",-d+"px",u,r);break;case"translateBottomLeft":"open"===e?a.transitionTranslateXY(s,"-50%","-50%",u,r):a.transitionTranslateXY(s,-c+"px",d+"px",u,r);break;case"translateBottomRight":"open"===e?a.transitionTranslateXY(s,"-50%","-50%",u,r):a.transitionTranslateXY(s,c+"px",d+"px",u,r)}"open"===e&&n(),"close"===e&&i()},initTransition:function(e,n){var i=e.find(".jdbpopup_subcontainer"),a=t(window).width(),s=t(window).height();switch(e.find(".jdbpopup_overlay").css({opacity:0}),n){case"fade":i.css({opacity:0});break;case"scaleIn":i.css({scale:0,opacity:0});break;case"scaleOut":i.css({scale:2,opacity:0});break;case"flipX":i.css({perspective:"1000px",rotateX:"180deg",opacity:0});break;case"flipY":i.css({perspective:"1000px",rotateY:"180deg",opacity:0});break;case"slide":i.css({transformOrigin:"0px 0px",scale:[1,0]});break;case"translateLeft":i.css({x:-a+"px"});break;case"translateRight":i.css({x:a+"px"});break;case"translateTop":i.css({y:-s+"px"});break;case"translateBottom":i.css({y:s+"px"});break;case"translateTopLeft":i.css({x:-a+"px",y:-s+"px"});break;case"translateTopRight":i.css({x:a+"px",y:-s+"px"});break;case"translateBottomLeft":i.css({x:-a+"px",y:s+"px"});break;case"translateBottomRight":i.css({x:a+"px",y:s+"px"})}},transitionOpacity:function(t,e,n,i){t.find(".jdbpopup_subcontainer").transition({opacity:e,duration:n,easing:i})},transitionScale:function(t,e,n,i,a,s){t.find(".jdbpopup_subcontainer").transition({scale:[e,n],opacity:i,duration:a,easing:s})},transitionFlip:function(t,e,n,i,a,s){t.find(".jdbpopup_subcontainer").transition({perspective:"1000px",rotateX:e+"deg",rotateY:n+"deg",opacity:i,duration:a,easing:s})},transitionTranslateXY:function(t,e,n,i,a){t.find(".jdbpopup_subcontainer").transition({x:e,y:n,duration:i,easing:a})},transitionOverlay:function(t,e,n,i){t.find(".jdbpopup_overlay").transition({opacity:e,duration:n,easing:i})}},jdbpopup_template={popup_container:function(){var t='<div id="jdbpopup_container"><div class="jdbpopup_overlay"></div><div class="jdbpopup_subcontainer" onmouseover="stop()" onmouseout="start()"><img src="" alt="" width="100%" height="100%"><div class="jdbpopup_caption"></div><span class="leftClickPortSl" onclick="lCl()"><i class="'+SliderLeftIconType+' totLeft"></i></span><span class="rightClickPortSl" onclick="rCl()"><i class="'+SliderRightIconType+' totRight"></i></span><i class="jdbpopup_close '+DelIconType+' portDelIcPop" onclick="closeClick()"></i>';return t},resetScroll:function(e){var n=t(window).scrollTop(),i=t(window).scrollLeft();e?(t("body").css("overflow","auto"),t(window).off("scroll")):(t("body").css("overflow","hidden"),t(window).scroll(function(){t(this).scrollTop(n).scrollLeft(i)}));if(jQuery(window).width()<=popImgWidth){jQuery('.portDelIcPop').css('font-size',Math.ceil(DelIconSize*jQuery(window).width()/popImgWidth));jQuery('.portDelIcPop').css('padding',Math.ceil(5*jQuery(window).width()/popImgWidth));jQuery('.carCl').css('font-size',Math.ceil(CarSliderIconSize*jQuery(window).width()/popImgWidth));jQuery('.totLeft').css('font-size',Math.ceil(SliderIconSize*jQuery(window).width()/popImgWidth));jQuery('.totRight').css('font-size',Math.ceil(SliderIconSize*jQuery(window).width()/popImgWidth));jQuery('#jdbpopup_container .jdbpopup_subcontainer .jdbpopup_caption.caption_on').css('font-size',Math.ceil(SliderTitleImgFontSize*jQuery(window).width()/popImgWidth));jQuery('#jdbpopup_container .jdbpopup_subcontainer .jdbpopup_caption.caption_on').css('padding','5px 0px');}}},this.each(function(){jdbpopup_init.init<?php echo $Total_Soft_Portfolio;?>(this,t(this))})}}(jQuery),checkClassJdbpopup<?php echo $Total_Soft_Portfolio; ?>();
				</script>
			<?php } else if($TotalSoftPortfolioOpt[0]->TotalSoftPortfolio_SetType == 'Gallery Portfolio/Content Popup'){ ?>
				<script src="<?php echo plugins_url('../JS/jquery.quicksand.js',__FILE__);?>" type="text/javascript"></script>
				<script src="<?php echo plugins_url('../JS/jquery.easing.js',__FILE__);?>" type="text/javascript"></script>
				<script type="text/javascript">
					jQuery.noConflict();
						jQuery(document).ready(function($){
							function lightboxPhoto() {
								jQuery("a[rel^='TSprettyPhoto']").TSprettyPhoto({ animationSpeed:'fast', slideshow:5000, theme:'light_rounded', show_title:false, overlay_gallery: false });
							}
							if(jQuery().TSprettyPhoto) { lightboxPhoto(); }
							if (jQuery().quicksand)
							{
								var $data = $(".totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?>").clone();
								$('.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?> li').click(function(e) {
									$(".filter li").removeClass("active<?php echo $Total_Soft_Portfolio;?>");
									var filterClass=$(this).attr('class').split(' ').slice(-1)[0];
									if (filterClass == 'all') { var $filteredData = $data.find('.totalsoft-portfolio-item2<?php echo $Total_Soft_Portfolio; ?>'); }
									else { var $filteredData = $data.find('.totalsoft-portfolio-item2<?php echo $Total_Soft_Portfolio; ?>[data-type=' + filterClass + ']'); }
									$(".totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?>").quicksand($filteredData, {
										duration: 600,
										easing: 'swing'
									}, function () {
										lightboxPhoto();
									});
									$(this).addClass("active<?php echo $Total_Soft_Portfolio;?>");
									return false;
								});
							}
						});
				</script>
				<link href="<?php echo plugins_url('../CSS/TSprettyPhoto.css',__FILE__);?>" rel="stylesheet" type="text/css" />
				<script type="text/javascript">
					function resp(){
						jQuery('.tspp_description').css('font-size',Math.ceil(<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>*jQuery('.tspp_hoverContainer').width()/(jQuery('.tspp_hoverContainer').width()+50)));
						jQuery('.totalsoft-port-cpop-close').css({'font-size':Math.ceil(<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_09;?>*jQuery('.tspp_hoverContainer').width()/(jQuery('.tspp_hoverContainer').width()+50)), 'line-height':Math.ceil(<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_09;?>*jQuery('.tspp_hoverContainer').width()/(jQuery('.tspp_hoverContainer').width()+50))+'px'});
						jQuery('.totalsoft-port-cpop-pl-pa').css({'font-size':Math.ceil(<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?>*jQuery('.tspp_hoverContainer').width()/(jQuery('.tspp_hoverContainer').width()+50)), 'line-height':Math.ceil(<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?>*jQuery('.tspp_hoverContainer').width()/(jQuery('.tspp_hoverContainer').width()+50))+'px'});
						jQuery('.totalsoft-port-cpop-nepr').css({'font-size':Math.ceil(<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_14;?>*jQuery('.tspp_hoverContainer').width()/(jQuery('.tspp_hoverContainer').width()+50)), 'line-height':Math.ceil(<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_14;?>*jQuery('.tspp_hoverContainer').width()/(jQuery('.tspp_hoverContainer').width()+50))+'px'});
						jQuery('.totalsoft-port-cpop-text').css({'font-size':Math.ceil(<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_16;?>*jQuery('.tspp_hoverContainer').width()/(jQuery('.tspp_hoverContainer').width()+50))});
					}
					(function($){$.TSprettyPhoto={version:'3.0'};$.fn.TSprettyPhoto=function(tspp_settings){tspp_settings=jQuery.extend({animation_speed:'fast',slideshow:false,autoplay_slideshow:false,opacity:0.80,show_title:true,allow_resize:true,default_width:500,default_height:344,counter_separator_label:'/',theme:'facebook',hideflash:false,wmode:'opaque',autoplay:true,modal:false,overlay_gallery:true,keyboard_shortcuts:true,changepicturecallback:function(){},callback:function(){},markup:'<div class="tspp_pic_holder"> \
				      <div class="tspp_top"> \
				       <div class="tspp_left"></div> \
				       <div class="tspp_middle"></div> \
				       <div class="tspp_right"></div> \
				      </div> \
				      <div class="tspp_content_container"> \
				       <div class="tspp_left"> \
				       <div class="tspp_right"> \
				        <div class="tspp_content"> \
				         <div class="tspp_loaderIcon"></div> \
				         <div class="tspp_fade"> \
				          <a href="#" class="tspp_expand" title="Expand the image">Expand</a> \
				          <div class="tspp_hoverContainer"> \
				           <a class="tspp_next" href="#"> </a> \
				           <a class="tspp_previous" href="#"> </a> \
				          </div> \
				          <div id="tspp_full_res"></div> \
				          <div class="tspp_details clearfix"> \
				           <p class="tspp_description"></p> \
				           <i class="totalsoft-port-cpop-close tspp_close totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?>"><span><?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_11;?></span></i> \
				           <div class="tspp_nav"> \
				            <i href="#" class="tspp_arrow_previous totalsoft-port-cpop-nepr totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_13;?>-left"></i> \
				            <p class="currentTextHolder totalsoft-port-cpop-text">0/0</p> \
				            <i href="#" class="tspp_arrow_next totalsoft-port-cpop-nepr totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_13;?>-right"></i> \
				           </div> \
				          </div> \
				         </div> \
				        </div> \
				       </div> \
				       </div> \
				      </div> \
				      <div class="tspp_bottom"> \
				       <div class="tspp_left"></div> \
				       <div class="tspp_middle"></div> \
				       <div class="tspp_right"></div> \
				      </div> \
				     </div> \
				     <div class="tspp_overlay"></div>',gallery_markup:'<div class="tspp_gallery"> \
				        <a href="#" class="tspp_arrow_previous">Previous</a> \
				        <ul> \
				         {gallery} \
				        </ul> \
				        <a href="#" class="tspp_arrow_next">Next</a> \
				       </div>',image_markup:'<img id="fullResImage" src="" />',flash_markup:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',quicktime_markup:'<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',iframe_markup:'<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',inline_markup:'<div class="tspp_inline clearfix">{content}</div>',custom_markup:''},tspp_settings);var matchedObjects=this,percentBased=false,correctSizes,tspp_open,tspp_contentHeight,tspp_contentWidth,tspp_containerHeight,tspp_containerWidth,windowHeight=$(window).height(),windowWidth=$(window).width(),tspp_slideshow;doresize=true,scroll_pos=_get_scroll();$(window).unbind('resize').resize(function(){_center_overlay();_resize_overlay();});if(tspp_settings.keyboard_shortcuts){$(document).unbind('keydown').keydown(function(e){setTimeout(function(){resp()},450);if(typeof $tspp_pic_holder!='undefined'){if($tspp_pic_holder.is(':visible')){switch(e.keyCode){case 37:$.TSprettyPhoto.changePage('previous');break;case 39:$.TSprettyPhoto.changePage('next');break;case 27:if(!settings.modal)
				$.TSprettyPhoto.close();break;};return false;};};});}
				$.TSprettyPhoto.initialize=function(){settings=tspp_settings;if($.browser.msie&&parseInt($.browser.version)==6)settings.theme="light_square";_buildOverlay(this);if(settings.allow_resize)
				$(window).scroll(function(){_center_overlay();});_center_overlay();set_position=jQuery.inArray($(this).attr('href'),tspp_images);$.TSprettyPhoto.open();return false;}
				$.TSprettyPhoto.open=function(event){if(typeof settings=="undefined"){settings=tspp_settings;if($.browser.msie&&$.browser.version==6)settings.theme="light_square";_buildOverlay(event.target);tspp_images=$.makeArray(arguments[0]);tspp_titles=(arguments[1])?$.makeArray(arguments[1]):$.makeArray("");tspp_descriptions=(arguments[2])?$.makeArray(arguments[2]):$.makeArray("");isSet=(tspp_images.length>1)?true:false;set_position=0;}
				if($.browser.msie&&$.browser.version==6)$('select').css('visibility','hidden');if(settings.hideflash)$('object,embed').css('visibility','hidden');_checkPosition($(tspp_images).size());$('.tspp_loaderIcon').show();if($ppt.is(':hidden'))$ppt.css('opacity',0).show();$tspp_overlay.show().fadeTo(settings.animation_speed,settings.opacity);$tspp_pic_holder.find('.currentTextHolder').text((set_position+1)+settings.counter_separator_label+$(tspp_images).size());$tspp_pic_holder.find('.tspp_description').show().html(unescape(tspp_descriptions[set_position]));(settings.show_title&&tspp_titles[set_position]!=""&&typeof tspp_titles[set_position]!="undefined")?$ppt.html(unescape(tspp_titles[set_position])):$ppt.html('&nbsp;');movie_width=(parseFloat(grab_param('width',tspp_images[set_position])))?grab_param('width',tspp_images[set_position]):settings.default_width.toString();movie_height=(parseFloat(grab_param('height',tspp_images[set_position])))?grab_param('height',tspp_images[set_position]):settings.default_height.toString();if(movie_width.indexOf('%')!=-1||movie_height.indexOf('%')!=-1){movie_height=parseFloat(($(window).height()*parseFloat(movie_height)/100)-150);movie_width=parseFloat(($(window).width()*parseFloat(movie_width)/100)-150);percentBased=true;}else{percentBased=false;}
				$tspp_pic_holder.fadeIn(function(){resp();imgPreloader="";switch(_getFileType(tspp_images[set_position])){case'image':imgPreloader=new Image();nextImage=new Image();if(isSet&&set_position>$(tspp_images).size())nextImage.src=tspp_images[set_position+1];prevImage=new Image();if(isSet&&tspp_images[set_position-1])prevImage.src=tspp_images[set_position-1];$tspp_pic_holder.find('#tspp_full_res')[0].innerHTML=settings.image_markup;$tspp_pic_holder.find('#fullResImage').attr('src',tspp_images[set_position]);imgPreloader.onload=function(){correctSizes=_fitToViewport(imgPreloader.width,imgPreloader.height);_showContent();};imgPreloader.onerror=function(){alert('Image cannot be loaded. Make sure the path is correct and image exist.');$.TSprettyPhoto.close();};imgPreloader.src=tspp_images[set_position];break;case'youtube':correctSizes=_fitToViewport(movie_width,movie_height);movie='http://www.youtube.com/v/'+grab_param('v',tspp_images[set_position]);if(settings.autoplay)movie+="&autoplay=1";toInject=settings.flash_markup.replace(/{width}/g,correctSizes['width']).replace(/{height}/g,correctSizes['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,movie);break;case'vimeo':correctSizes=_fitToViewport(movie_width,movie_height);movie_id=tspp_images[set_position];var regExp=/http:\/\/(www\.)?vimeo.com\/(\d+)/;var match=movie_id.match(regExp);movie='http://player.vimeo.com/video/'+match[2]+'?title=0&amp;byline=0&amp;portrait=0';if(settings.autoplay)movie+="&autoplay=1;";vimeo_width=correctSizes['width']+'/embed/?moog_width='+correctSizes['width'];toInject=settings.iframe_markup.replace(/{width}/g,vimeo_width).replace(/{height}/g,correctSizes['height']).replace(/{path}/g,movie);break;case'quicktime':correctSizes=_fitToViewport(movie_width,movie_height);correctSizes['height']+=15;correctSizes['contentHeight']+=15;correctSizes['containerHeight']+=15;toInject=settings.quicktime_markup.replace(/{width}/g,correctSizes['width']).replace(/{height}/g,correctSizes['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,tspp_images[set_position]).replace(/{autoplay}/g,settings.autoplay);break;case'flash':correctSizes=_fitToViewport(movie_width,movie_height);flash_vars=tspp_images[set_position];flash_vars=flash_vars.substring(tspp_images[set_position].indexOf('flashvars')+10,tspp_images[set_position].length);filename=tspp_images[set_position];filename=filename.substring(0,filename.indexOf('?'));toInject=settings.flash_markup.replace(/{width}/g,correctSizes['width']).replace(/{height}/g,correctSizes['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,filename+'?'+flash_vars);break;case'iframe':correctSizes=_fitToViewport(movie_width,movie_height);frame_url=tspp_images[set_position];frame_url=frame_url.substr(0,frame_url.indexOf('iframe')-1);toInject=settings.iframe_markup.replace(/{width}/g,correctSizes['width']).replace(/{height}/g,correctSizes['height']).replace(/{path}/g,frame_url);break;case'custom':correctSizes=_fitToViewport(movie_width,movie_height);toInject=settings.custom_markup;break;case'inline':myClone=$(tspp_images[set_position]).clone().css({'width':settings.default_width}).wrapInner('<div id="tspp_full_res"><div class="tspp_inline clearfix"></div></div>').appendTo($('body'));correctSizes=_fitToViewport($(myClone).width(),$(myClone).height());$(myClone).remove();toInject=settings.inline_markup.replace(/{content}/g,$(tspp_images[set_position]).html());break;};if(!imgPreloader){$tspp_pic_holder.find('#tspp_full_res')[0].innerHTML=toInject;_showContent();};});return false;};
				$.TSprettyPhoto.changePage=function(direction){currentGalleryPage=0;if(direction=='previous'){set_position--;if(set_position<0){set_position=0;return;}}else if(direction=='next'){set_position++;if(set_position>$(tspp_images).size()-1){set_position=0;}}else{set_position=direction;};if(!doresize)doresize=true;$('.tspp_contract').removeClass('tspp_contract').addClass('tspp_expand');_hideContent(function(){$.TSprettyPhoto.open();});};$.TSprettyPhoto.changeGalleryPage=function(direction){if(direction=='next'){currentGalleryPage++;if(currentGalleryPage>totalPage){currentGalleryPage=0};}else if(direction=='previous'){currentGalleryPage--;if(currentGalleryPage<0){currentGalleryPage=totalPage;}}else{currentGalleryPage=direction;};itemsToSlide=(currentGalleryPage==totalPage)?tspp_images.length-((totalPage)*itemsPerPage):itemsPerPage;$tspp_pic_holder.find('.tspp_gallery li').each(function(i){$(this).animate({'left':(i*itemWidth)-((itemsToSlide*itemWidth)*currentGalleryPage)});});};$.TSprettyPhoto.startSlideshow=function(){setTimeout(function(){resp()},450);if(typeof tspp_slideshow=='undefined'){$tspp_pic_holder.find('.tspp_play').unbind('click').removeClass('tspp_play totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>').addClass('tspp_pause totalsoft totalsoft-<?php echo str_replace("play","pause", $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05); ?>').click(function(){$.TSprettyPhoto.stopSlideshow();return false;});tspp_slideshow=setInterval($.TSprettyPhoto.startSlideshow,settings.slideshow);}else{$.TSprettyPhoto.changePage('next');};}
				$.TSprettyPhoto.stopSlideshow=function(){$tspp_pic_holder.find('.tspp_pause').unbind('click').removeClass('tspp_pause totalsoft totalsoft-<?php echo str_replace("play","pause", $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05); ?>').addClass('tspp_play totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>').click(function(){$.TSprettyPhoto.startSlideshow();return false;});clearInterval(tspp_slideshow);tspp_slideshow=undefined;}
				$.TSprettyPhoto.close=function(){clearInterval(tspp_slideshow);$tspp_pic_holder.stop().find('object,embed').css('visibility','hidden');$('div.tspp_pic_holder,div.ppt,.tspp_fade').fadeOut(settings.animation_speed,function(){$(this).remove();});$tspp_overlay.fadeOut(settings.animation_speed,function(){if($.browser.msie&&$.browser.version==6)$('select').css('visibility','visible');if(settings.hideflash)$('object,embed').css('visibility','visible');$(this).remove();$(window).unbind('scroll');settings.callback();doresize=true;tspp_open=false;delete settings;});};_showContent=function(){$('.tspp_loaderIcon').hide();$ppt.fadeTo(settings.animation_speed,1);projectedTop=scroll_pos['scrollTop']+((windowHeight/2)-(correctSizes['containerHeight']/2));if(projectedTop<0)projectedTop=0;$tspp_pic_holder.find('.tspp_content').animate({'height':correctSizes['contentHeight']},settings.animation_speed);$tspp_pic_holder.animate({'top':projectedTop,'left':(windowWidth/2)-(correctSizes['containerWidth']/2),'width':correctSizes['containerWidth']},settings.animation_speed,function(){$tspp_pic_holder.find('.tspp_hoverContainer,#fullResImage').height(correctSizes['height']).width(correctSizes['width']);$tspp_pic_holder.find('.tspp_fade').fadeIn(settings.animation_speed);if(isSet&&_getFileType(tspp_images[set_position])=="image"){$tspp_pic_holder.find('.tspp_hoverContainer').show()}else{$tspp_pic_holder.find('.tspp_hoverContainer').hide();}
				if(correctSizes['resized'])$('a.tspp_expand,a.tspp_contract').fadeIn(settings.animation_speed);if(settings.autoplay_slideshow&&!tspp_slideshow&&!tspp_open)$.TSprettyPhoto.startSlideshow();settings.changepicturecallback();tspp_open=true;});_insert_gallery();};function _hideContent(callback){$tspp_pic_holder.find('#tspp_full_res object,#tspp_full_res embed').css('visibility','hidden');$tspp_pic_holder.find('.tspp_fade').fadeOut(settings.animation_speed,function(){$('.tspp_loaderIcon').show();callback();});};function _checkPosition(setCount){if(set_position==setCount-1){$tspp_pic_holder.find('a.tspp_next').css('visibility','hidden');$tspp_pic_holder.find('a.tspp_next').addClass('disabled').unbind('click');}else{$tspp_pic_holder.find('a.tspp_next').css('visibility','visible');$tspp_pic_holder.find('a.tspp_next.disabled').removeClass('disabled').bind('click',function(){$.TSprettyPhoto.changePage('next');return false;});};if(set_position==0){$tspp_pic_holder.find('a.tspp_previous').css('visibility','hidden').addClass('disabled').unbind('click');}else{$tspp_pic_holder.find('a.tspp_previous.disabled').css('visibility','visible').removeClass('disabled').bind('click',function(){$.TSprettyPhoto.changePage('previous');return false;});};(setCount>1)?$('.tspp_nav').show():$('.tspp_nav').hide();};function _fitToViewport(width,height){resized=false;_getDimensions(width,height);imageWidth=width,imageHeight=height;if(((tspp_containerWidth+60>windowWidth)||(tspp_containerHeight+60>windowHeight))&&doresize&&settings.allow_resize&&!percentBased){resized=true,fitting=false;while(!fitting){if((tspp_containerWidth+60>windowWidth)){imageWidth=(windowWidth-200);imageHeight=(height/width)*imageWidth;}else if((tspp_containerHeight+60>windowHeight)){imageHeight=(windowHeight-200);imageWidth=(width/height)*imageHeight;}else{fitting=true;};tspp_containerHeight=imageHeight,tspp_containerWidth=imageWidth;};_getDimensions(imageWidth,imageHeight);};return{width:Math.floor(imageWidth),height:Math.floor(imageHeight),containerHeight:Math.floor(tspp_containerHeight),containerWidth:Math.floor(tspp_containerWidth)+40,contentHeight:Math.floor(tspp_contentHeight),contentWidth:Math.floor(tspp_contentWidth),resized:resized};};function _getDimensions(width,height){width=parseFloat(width);height=parseFloat(height);$tspp_details=$tspp_pic_holder.find('.tspp_details');$tspp_details.width(width);detailsHeight=parseFloat($tspp_details.css('marginTop'))+parseFloat($tspp_details.css('marginBottom'));$tspp_details=$tspp_details.clone().appendTo($('body')).css({'position':'absolute','top':-10000});detailsHeight+=$tspp_details.height();detailsHeight=(detailsHeight<=34)?36:detailsHeight;if($.browser.msie&&$.browser.version==7)detailsHeight+=8;$tspp_details.remove();tspp_contentHeight=height+detailsHeight;tspp_contentWidth=width;tspp_containerHeight=tspp_contentHeight+$ppt.height()+$tspp_pic_holder.find('.tspp_top').height()+$tspp_pic_holder.find('.tspp_bottom').height();tspp_containerWidth=width;}
				function _getFileType(itemSrc){if(itemSrc.match(/youtube\.com\/watch/i)){return'youtube';}else if(itemSrc.match(/vimeo\.com/i)){return'vimeo';}else if(itemSrc.indexOf('.mov')!=-1){return'quicktime';}else if(itemSrc.indexOf('.swf')!=-1){return'flash';}else if(itemSrc.indexOf('iframe')!=-1){return'iframe';}else if(itemSrc.indexOf('custom')!=-1){return'custom';}else if(itemSrc.substr(0,1)=='#'){return'inline';}else{return'image';};};function _center_overlay(){if(doresize&&typeof $tspp_pic_holder!='undefined'){scroll_pos=_get_scroll();titleHeight=$ppt.height(),contentHeight=$tspp_pic_holder.height(),contentwidth=$tspp_pic_holder.width();projectedTop=(windowHeight/2)+scroll_pos['scrollTop']-(contentHeight/2);$tspp_pic_holder.css({'top':projectedTop,'left':(windowWidth/2)+scroll_pos['scrollLeft']-(contentwidth/2)});};};function _get_scroll(){if(self.pageYOffset){return{scrollTop:self.pageYOffset,scrollLeft:self.pageXOffset};}else if(document.documentElement&&document.documentElement.scrollTop){return{scrollTop:document.documentElement.scrollTop,scrollLeft:document.documentElement.scrollLeft};}else if(document.body){return{scrollTop:document.body.scrollTop,scrollLeft:document.body.scrollLeft};};};function _resize_overlay(){windowHeight=$(window).height(),windowWidth=$(window).width();if(typeof $tspp_overlay!="undefined")$tspp_overlay.height($(document).height());};function _insert_gallery(){if(isSet&&settings.overlay_gallery&&_getFileType(tspp_images[set_position])=="image"){itemWidth=52+5;navWidth=(settings.theme=="facebook")?58:38;itemsPerPage=Math.floor((correctSizes['containerWidth']-100-navWidth)/itemWidth);itemsPerPage=(itemsPerPage<tspp_images.length)?itemsPerPage:tspp_images.length;totalPage=Math.ceil(tspp_images.length/itemsPerPage)-1;if(totalPage==0){navWidth=0;$tspp_pic_holder.find('.tspp_gallery .tspp_arrow_next,.tspp_gallery .tspp_arrow_previous').hide();}else{$tspp_pic_holder.find('.tspp_gallery .tspp_arrow_next,.tspp_gallery .tspp_arrow_previous').show();};galleryWidth=itemsPerPage*itemWidth+navWidth;$tspp_pic_holder.find('.tspp_gallery').width(galleryWidth).css('margin-left',-(galleryWidth/2));$tspp_pic_holder.find('.tspp_gallery ul').width(itemsPerPage*itemWidth).find('li.selected').removeClass('selected');goToPage=(Math.floor(set_position/itemsPerPage)<=totalPage)?Math.floor(set_position/itemsPerPage):totalPage;if(itemsPerPage){$tspp_pic_holder.find('.tspp_gallery').hide().show().removeClass('disabled');}else{$tspp_pic_holder.find('.tspp_gallery').hide().addClass('disabled');}
				$.TSprettyPhoto.changeGalleryPage(goToPage);$tspp_pic_holder.find('.tspp_gallery ul li:eq('+set_position+')').addClass('selected');}else{$tspp_pic_holder.find('.tspp_content').unbind('mouseenter mouseleave');$tspp_pic_holder.find('.tspp_gallery').hide();}}
				function _buildOverlay(caller){theRel=$(caller).attr('rel');galleryRegExp=/\[(?:.*)\]/;isSet=(galleryRegExp.exec(theRel))?true:false;tspp_images=(isSet)?jQuery.map(matchedObjects,function(n,i){if($(n).attr('rel').indexOf(theRel)!=-1)return $(n).attr('href');}):$.makeArray($(caller).attr('href'));tspp_titles=(isSet)?jQuery.map(matchedObjects,function(n,i){if($(n).attr('rel').indexOf(theRel)!=-1)return($(n).find('img').attr('alt'))?$(n).find('img').attr('alt'):"";}):$.makeArray($(caller).find('img').attr('alt'));tspp_descriptions=(isSet)?jQuery.map(matchedObjects,function(n,i){if($(n).attr('rel').indexOf(theRel)!=-1)return($(n).attr('title'))?$(n).attr('title'):"";}):$.makeArray($(caller).attr('title'));$('body').append(settings.markup);$tspp_pic_holder=$('.tspp_pic_holder'),$ppt=$('.ppt'),$tspp_overlay=$('div.tspp_overlay');if(isSet&&settings.overlay_gallery){currentGalleryPage=0;toInject="";for(var i=0;i<tspp_images.length;i++){var regex=new RegExp("(.*?)\.(jpg|jpeg|png|gif)$");var results=regex.exec(tspp_images[i]);if(!results){classname='default';}else{classname='';}
				toInject+="<li class='"+classname+"'><a href='#'><img src='"+tspp_images[i]+"' width='50' alt='' /></a></li>";};toInject=settings.gallery_markup.replace(/{gallery}/g,toInject);$tspp_pic_holder.find('#tspp_full_res').after(toInject);$tspp_pic_holder.find('.tspp_gallery .tspp_arrow_next').click(function(){$.TSprettyPhoto.changeGalleryPage('next');$.TSprettyPhoto.stopSlideshow();return false;});$tspp_pic_holder.find('.tspp_gallery .tspp_arrow_previous').click(function(){$.TSprettyPhoto.changeGalleryPage('previous');$.TSprettyPhoto.stopSlideshow();return false;});$tspp_pic_holder.find('.tspp_content').hover(function(){$tspp_pic_holder.find('.tspp_gallery:not(.disabled)').fadeIn();},function(){$tspp_pic_holder.find('.tspp_gallery:not(.disabled)').fadeOut();});itemWidth=52+5;$tspp_pic_holder.find('.tspp_gallery ul li').each(function(i){$(this).css({'position':'absolute','left':i*itemWidth});$(this).find('a').unbind('click').click(function(){$.TSprettyPhoto.changePage(i);$.TSprettyPhoto.stopSlideshow();return false;});});};if(settings.slideshow){$tspp_pic_holder.find('.tspp_nav').prepend('<i class="totalsoft-port-cpop-pl-pa tspp_play totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>"></i>')
				$tspp_pic_holder.find('.tspp_nav .tspp_play').click(function(){$.TSprettyPhoto.startSlideshow();return false;});};setTimeout(function(){resp();},650);$tspp_pic_holder.attr('class','tspp_pic_holder '+settings.theme);$tspp_overlay.css({'opacity':0,'height':$(document).height(),'width':$(document).width()}).bind('click',function(){if(!settings.modal)$.TSprettyPhoto.close();});$('i.tspp_close').bind('click',function(){$.TSprettyPhoto.close();return false;});$('a.tspp_expand').bind('click',function(e){if($(this).hasClass('tspp_expand')){$(this).removeClass('tspp_expand').addClass('tspp_contract');doresize=false;}else{$(this).removeClass('tspp_contract').addClass('tspp_expand');doresize=true;};_hideContent(function(){$.TSprettyPhoto.open();});return false;});$tspp_pic_holder.find('.tspp_previous, .tspp_nav .tspp_arrow_previous').bind('click',function(){setTimeout(function(){resp()},450);$.TSprettyPhoto.changePage('previous');$.TSprettyPhoto.stopSlideshow();return false;});$tspp_pic_holder.find('.tspp_next, .tspp_nav .tspp_arrow_next').bind('click',function(){setTimeout(function(){resp()},450);$.TSprettyPhoto.changePage('next');$.TSprettyPhoto.stopSlideshow();return false;});_center_overlay();};return this.unbind('click').click($.TSprettyPhoto.initialize)};function grab_param(name,url){name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(url);return(results==null)?"":results[1];}})(jQuery);
				</script>
				<style type="text/css">
					div.tspp_pic_holder
					{
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34;?> !important;
						border: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?> !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_38;?>px !important;
					}
					.tspp_description
					{
						display: <?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39=='false'){echo 'none';}?>;
						text-align: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?> !important;
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>px;
						font-family: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?> !important;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?> !important;
					}
					.totalsoft-port-cpop-pl-pa
					{
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?>px;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07;?> !important;
					}
					.totalsoft-port-cpop-close
					{
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_09;?>px;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10;?> !important;
					}
					.totalsoft-port-cpop-close span
					{
						font-family: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_12;?> !important;
						margin-left:3px !important;
					}
					.totalsoft-port-cpop-nepr
					{
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_14;?>px;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_15;?> !important;
					}
					.totalsoft-port-cpop-text
					{
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_16;?>px;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_17;?> !important;
					}
					.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?>
					{
						background-color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_20;?> !important;
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_18!='true'){ ?>
							display: none;
						<?php }?>
						font-family: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_26;?> !important;
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_25;?>px;
					}
					.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?> li
					{
						font-family: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_26;?> !important;
						background-color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_23;?> !important;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24;?> !important;
					}
					.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?> li a
					{
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_24;?> !important;
					}
					.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?> li.active<?php echo $Total_Soft_Portfolio;?>
					{
						background-color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_21;?> !important;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_22;?> !important;
					}
					.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?> li.active<?php echo $Total_Soft_Portfolio;?> a
					{
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_22;?> !important;
					}
					.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?> li:hover
					{
						background-color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_27;?> !important;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_28;?> !important;
					}
					.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?>{
						margin-left:0 !important;
					}
					.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?> li:hover a
					{
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_28;?> !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li
					{
						display:inline-block;
						overflow: hidden;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?> !important;
						width: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01;?>px;
						height:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01*3/4;?>px;
						position:relative;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px !important;
						margin:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02;?>px !important;
						box-shadow:0 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?> !important;
						-webkit-box-shadow:0 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?> !important;
						-moz-box-shadow:0 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?> !important;
						perspective:800px !important;
						-moz-perspective:800px !important;
						-webkit-perspective:800px !important;
						padding: 0 !important;
					}
					.totalsoft-image-block { display:block; position: absolute; width:100%; height:100%; }
					.totalsoft-image-block img { margin: 0 !important; background:#FFFFFF; width:100%; height: 100%; max-width:none !important; }
					.TotPortImgHov1
					{
						position:absolute;
						top:0px;
						left:0px;
						width:100%;
						height:100%;
						max-width:none !important;
						-ms-transform:rotate(0deg);
						-webkit-transform:rotate(0deg);
						-moz-transform:rotate(0deg);
						-o-transform:rotate(0deg);
						transform:rotate(0deg);
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgHov1
					{
						width:200%;
						height:200%;
						left:-50%;
						top:-50%;
						-ms-transform:rotate(25deg);
						-webkit-transform:rotate(25deg);
						-moz-transform:rotate(25deg);
						transform:rotate(25deg);
					}
					.TotPortImgHov2
					{
						position:absolute;
						top:0px;
						left:0px;
						width:100%;
						height:100%;
						max-width:none !important;
						-ms-transform:rotate(0deg);
						-webkit-transform:rotate(0deg);
						-moz-transform:rotate(0deg);
						transform:rotate(0deg);
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgHov2
					{
						width:200%;
						height:200%;
						left:-50%;
						top:-50%;
						-ms-transform:rotate(-25deg);
						-moz-transform:rotate(-25deg);
						-webkit-transform:rotate(-25deg);
						transform:rotate(-25deg);
					}
					.TotPortImgHov3
					{
						position:absolute;
						top:0px;
						left:0px;
						width:100%;
						height:100%;
						max-width:none !important;
						-ms-transform:rotate(0deg);
						-moz-transform:rotate(0deg);
						-webkit-transform:rotate(0deg);
						transform:rotate(0deg);
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgHov3 { width:150%; height:150%; }
					.TotPortImgHov4
					{
						position:absolute;
						top:0px;
						left:0px;
						width:100%;
						height:100%;
						max-width:none !important;
						-ms-transform:rotate(0deg);
						-moz-transform:rotate(0deg);
						-webkit-transform:rotate(0deg);
						transform:rotate(0deg);
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgHov4 { width:150%; height:150%; left:-25%; top:-25%; }
					.TotPortImgHov5
					{
						position:absolute;
						top:0px;
						right:0px;
						width:100%;
						height:100%;
						max-width:none !important;
						-ms-transform:rotate(0deg);
						-webkit-transform:rotate(0deg);
						-moz-transform:rotate(0deg);
						transform:rotate(0deg);
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgHov5 { width:150%; height:150%; }
					.TotPortImgHov6
					{
						position:absolute;
						bottom:0px;
						right:0px;
						width:100%;
						height:100%;
						max-width:none !important;
						-ms-transform:rotate(0deg);
						-moz-transform:rotate(0deg);
						-webkit-transform:rotate(0deg);
						transform:rotate(0deg);
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgHov6 { width:150%; height:150%; }
					.TotPortImgHov7
					{
						position:absolute;
						bottom:0px;
						left:0px;
						width:100%;
						height:100%;
						max-width:none !important;
						-ms-transform:rotate(0deg);
						-moz-transform:rotate(0deg);
						-webkit-transform:rotate(0deg);
						transform:rotate(0deg);
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgHov7 { width:150%; height:150%; }
					.TotPortImgOv1
					{
						position:absolute;
						top:0px;
						left:0px;
						width:100%;
						height:100%;
						max-width:none !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>;
						opacity:0;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgOv1 { opacity:0.8; }
					.TotPortImgOv2
					{
						position:absolute !important;
						top:0% !important;
						left:100% !important;
						width:100% !important;
						height:100% !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						transform:rotate(-90deg) !important;
						-ms-transform:rotate(-90deg) !important;
						-webkit-transform:rotate(-90deg) !important;
						-moz-transform:rotate(-90deg) !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgOv2
					{
						left:0% !important;
						top:0% !important;
						transform:rotate(0deg) !important;
						-ms-transform:rotate(0deg) !important;
						-moz-transform:rotate(0deg) !important;
						-webkit-transform:rotate(0deg) !important;
					}
					.TotPortImgOv3
					{
						position:absolute !important;
						top:0% !important;
						left:100% !important;
						width:100% !important;
						height:100% !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						transform:rotateY(-180deg) !important;
						-ms-transform:rotateY(-180deg) !important;
						-moz-transform:rotateY(-180deg) !important;
						-webkit-transform:rotateY(-180deg) !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgOv3
					{
						left:0% !important;
						top:0% !important;
						transform:rotateY(0deg) !important;
						-ms-transform:rotateY(0deg) !important;
						-moz-transform:rotateY(0deg) !important;
						-webkit-transform:rotateY(0deg) !important;
					}
					.TotPortImgOv4
					{
						position:absolute !important;
						top:50% !important;
						left:50% !important;
						width:0% !important;
						height:0% !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						transform:translateY(-50%) translateX(-50%) rotate(-180deg) !important;
						-ms-transform:translateY(-50%) translateX(-50%) rotate(-180deg) !important;
						-moz-transform:translateY(-50%) translateX(-50%) rotate(-180deg) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(-180deg) !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgOv4
					{
						left:0% !important;
						top:0% !important;
						width:100% !important;
						height:100% !important;
						transform:rotate(0deg) !important;
						-ms-transform:rotate(0deg) !important;
						-moz-transform:rotate(0deg) !important;
						-webkit-transform:rotate(0deg) !important;
					}
					.TotPortImgOv5
					{
						position:absolute !important;
						top:50% !important;
						left:50% !important;
						width:0% !important;
						height:0% !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						transform:translateY(-50%) translateX(-50%) rotateX(-180deg) !important;
						-ms-transform:translateY(-50%) translateX(-50%) rotateX(-180deg) !important;
						-moz-transform:translateY(-50%) translateX(-50%) rotateX(-180deg) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) rotateX(-180deg) !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgOv5
					{
						width:100% !important;
						height:100% !important;
						transform:translateY(-50%) translateX(-50%) rotateX(0deg) !important;
						-ms-transform:translateY(-50%) translateX(-50%) rotateX(0deg) !important;
						-moz-transform:translateY(-50%) translateX(-50%) rotateX(0deg) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) rotateX(0deg) !important;
					}
					.TotPortImgOv6
					{
						position:absolute !important;
						top:50% !important;
						left:50% !important;
						width:0% !important;
						height:0% !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						transform:translateY(-50%) translateX(-50%) rotateY(-180deg) !important;
						-ms-transform:translateY(-50%) translateX(-50%) rotateY(-180deg) !important;
						-moz-transform:translateY(-50%) translateX(-50%) rotateY(-180deg) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) rotateY(-180deg) !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgOv6
					{
						width:100% !important;
						height:100% !important;
						transform:translateY(-50%) translateX(-50%) rotateY(0deg) !important;
						-ms-transform:translateY(-50%) translateX(-50%) rotateY(0deg) !important;
						-moz-transform:translateY(-50%) translateX(-50%) rotateY(0deg) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) rotateY(0deg) !important;
					}
					.TotPortImgOv7
					{
						position:absolute !important;
						top:50% !important;
						left:50% !important;
						width:0% !important;
						height:0% !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgOv7
					{
						left:0% !important;
						top:0% !important;
						width:100% !important;
						height:100% !important;
					}
					.TotPortImgOv8
					{
						position:absolute !important;
						top:50% !important;
						left:0% !important;
						width:100% !important;
						height:0% !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						visibility:hidden !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgOv8 { top:0% !important; height:100% !important; visibility:visible !important; }
					.TotPortImgOv9
					{
						position:absolute !important;
						top:0% !important;
						left:50% !important;
						width:0% !important;
						height:100% !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgOv9 { left:0% !important; width:100% !important; }
					.TotPortImgOv10
					{
						position:absolute !important;
						top:-100% !important;
						left:0% !important;
						width:100% !important;
						height:100% !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						opacity:0 !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgOv10 { top:0% !important; opacity:0.8 !important; }
					.TotPortImgOv11
					{
						position:absolute !important;
						top:0% !important;
						left:0% !important;
						width:100% !important;
						height:100% !important;
						border:20px solid red !important;
						opacity:0 !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortImgOv11 { opacity:0.8 !important; }
					.TotPortImgOv12
					{
						position:absolute !important;
						top:0% !important;
						left:0% !important;
						width:100% !important;
						height:100% !important;
						border:20px solid red !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.TotPortImgOv13
					{
						position:absolute !important;
						top:0% !important;
						left:0% !important;
						width:100% !important;
						height:100% !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-webkit-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-ms-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-o-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						-moz-transition:all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13/10;?>s linear !important;
						border-radius: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>px;
					}
					.TotPortHovTit1
					{
						position:absolute !important;
						top:-100% !important;
						width:100% !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>px !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						padding:1px 0px !important;
						text-align:center !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?> !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						font-weight: 400 !important;
						margin: 0 !important;
						line-height: 1 !important;
						letter-spacing: 0 !important;
						text-transform: none !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovTit1 { top:5% !important; }
					.TotPortHovTit2
					{
						position:absolute !important;
						top:5% !important;
						left:100% !important;
						transform:rotate(-90deg) !important;
						-ms-transform:rotate(-90deg) !important;
						-moz-transform:rotate(-90deg) !important;
						-webkit-transform:rotate(-90deg) !important;
						width:100% !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>px !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						padding:1px 0px !important;
						text-align:center !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?> !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						font-weight: 400 !important;
						margin: 0 !important;
						line-height: 1 !important;
						letter-spacing: 0 !important;
						text-transform: none !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovTit2
					{
						left:0% !important;
						transform:rotate(0deg) !important;
						-ms-transform:rotate(0deg) !important;
						-moz-transform:rotate(0deg) !important;
						-webkit-transform:rotate(0deg) !important;
					}
					.TotPortHovTit3
					{
						position:absolute !important;
						top:10% !important;
						left:15% !important;
						width:70% !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> !important;
						font-size:0px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						padding:0px 0px !important;
						text-align:center !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?> !important;
						opacity:0 !important;
						transition: all 0s linear !important;
						-webkit-transition: all 0s linear !important;
						-ms-transition: all 0s linear !important;
						-moz-transition: all 0s linear !important;
						-o-transition: all 0s linear !important;
						font-weight: 400 !important;
						margin: 0 !important;
						line-height: 1 !important;
						letter-spacing: 0 !important;
						text-transform: none !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovTit3
					{
						left:0% !important;
						top:5% !important;
						width:100% !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>px !important;
						padding:1px 0px !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						opacity:1 !important;
					}
					.TotPortHovTit4
					{
						position:absolute !important;
						top:25% !important;
						left:0% !important;
						width:100% !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>px !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						padding:1px 0px !important;
						text-align:center !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?> !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						font-weight: 400 !important;
						margin: 0 !important;
						line-height: 1 !important;
						letter-spacing: 0 !important;
						text-transform: none !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovTit4 { top:5% !important; }
					.TotPortHovTit5
					{
						position:absolute !important;
						top:5% !important;
						width:100% !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>px !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						padding:1px 0px !important;
						text-align:center !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?> !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						font-weight: 400 !important;
						margin: 0 !important;
						line-height: 1 !important;
						letter-spacing: 0 !important;
						text-transform: none !important;
					}
					.TotPortHovTit6
					{
						position:absolute !important;
						top:50% !important;
						left:0% !important;
						width:100% !important;
						display:inline !important;
						padding:0px !important;
						margin:0px !important;
						transform:translateY(-50%) !important;
						-ms-transform:translateY(-50%) !important;
						-moz-transform:translateY(-50%) !important;
						-webkit-transform:translateY(-50%) !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>px !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						text-align:center !important;
						opacity:1 !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						font-weight: 400 !important;
						margin: 0 !important;
						line-height: 1 !important;
						letter-spacing: 0 !important;
						text-transform: none !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovTit6
					{
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15-5;?>px !important;
						opacity:0 !important;
					}
					.TotPortHovTit7
					{
						position:absolute !important;
						top:100% !important;
						left:0% !important;
						width:100% !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> !important;
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?> !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>px !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						text-align:center !important;
						transform:translateY(0%);
						-ms-transform:translateY(0%);
						-moz-transform:translateY(0%);
						-webkit-transform:translateY(0%);
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						font-weight: 400 !important;
						margin: 0 !important;
						line-height: 1 !important;
						letter-spacing: 0 !important;
						text-transform: none !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovTit7 { top:0% !important; }
					.TotPortHovTit8
					{
						position:absolute !important;
						top:50% !important;
						right:0% !important;
						width:85% !important;
						display:inline !important;
						padding:0px !important;
						margin:0px !important;
						transform:translateY(-50%) !important;
						-ms-transform:translateY(-50%) !important;
						-moz-transform:translateY(-50%) !important;
						-webkit-transform:translateY(-50%) !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>px !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						text-align:left !important;
						opacity:1 !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						font-weight: 400 !important;
						margin: 0 !important;
						line-height: 1 !important;
						letter-spacing: 0 !important;
						text-transform: none !important;
					}
					.TotPortHovTit9
					{
						position:absolute !important;
						top:40% !important;
						left:0% !important;
						width:100% !important;
						display:inline !important;
						padding:0px !important;
						margin:0px !important;
						transform:translateY(-50%) !important;
						-ms-transform:translateY(-50%) !important;
						-moz-transform:translateY(-50%) !important;
						-webkit-transform:translateY(-50%) !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>px !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						text-align:center !important;
						opacity:1 !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						font-weight: 400 !important;
						margin: 0 !important;
						line-height: 1 !important;
						letter-spacing: 0 !important;
						text-transform: none !important;
					}
					.TotPortHovTit10
					{
						position:absolute !important;
						top:20% !important;
						left:0% !important;
						width:0% !important;
						display:inline !important;
						padding:0px !important;
						margin:0px !important;
						left:50% !important;
						font-size:0px !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						text-align:center !important;
						opacity:1 !important;
						transition: all 0s linear !important;
						-webkit-transition: all 0s linear !important;
						-ms-transition: all 0s linear !important;
						-moz-transition: all 0s linear !important;
						-o-transition: all 0s linear !important;
						font-weight: 400 !important;
						margin: 0 !important;
						line-height: 1 !important;
						letter-spacing: 0 !important;
						text-transform: none !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovTit10
					{
						width:100% !important;
						top:30% !important;
						left:0% !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>px !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
					}
					.TotPortHovTit11
					{
						position:absolute !important;
						top:20% !important;
						left:10% !important;
						width:40% !important;
						display:inline !important;
						transform:translateX(0%) !important;
						-ms-transform:translateX(0%) !important;
						-moz-transform:translateX(0%) !important;
						-webkit-transform:translateX(0%) !important;
						padding:0px !important;
						margin:0px !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>px !important;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?> !important;
						text-align:center !important;
						opacity:0 !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18/10;?>s linear !important;
						font-weight: 400 !important;
						margin: 0 !important;
						line-height: 1 !important;
						letter-spacing: 0 !important;
						text-transform: none !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovTit11
					{
						top:30% !important;
						left:50% !important;
						transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						opacity:1 !important;
					}
					.TotPortHovLine1
					{
						position:absolute !important;
						width:10% !important;
						height:10% !important;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
						top:50% !important;
						left:50% !important;
						opacity:0 !important;
						transform:translateY(-50%) translateX(-50%) !important;
						-ms-transform:translateY(-50%) translateX(-50%) !important;
						-moz-transform:translateY(-50%) translateX(-50%) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLine1 { width:90% !important; height:90% !important; opacity:1 !important; }
					.TotPortHovLine2
					{
						position:absolute !important;
						width:110% !important;
						height:110% !important;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
						top:50% !important;
						left:50% !important;
						opacity:0 !important;
						transform:translateY(-50%) translateX(-50%) !important;
						-ms-transform:translateY(-50%) translateX(-50%) !important;
						-moz-transform:translateY(-50%) translateX(-50%) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLine2 { width:90% !important; height:90% !important; opacity:1 !important; }
					.TotPortHovLine3
					{
						position:absolute !important;
						width:90% !important;
						height:90% !important;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
						border-right:0px solid #ffffff !important;
						top:50% !important;
						left:40% !important;
						opacity:0 !important;
						transform:translateY(-50%) translateX(-50%) !important;
						-ms-transform:translateY(-50%) translateX(-50%) !important;
						-moz-transform:translateY(-50%) translateX(-50%) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLine3 { left:50% !important; opacity:1 !important; }
					.TotPortHovLine4
					{
						position:absolute !important;
						width:0% !important;
						height:0% !important;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
						top:50% !important;
						left:10% !important;
						opacity:0 !important;
						transform:translateY(-50%) translateX(0%) !important;
						-ms-transform:translateY(-50%) translateX(0%) !important;
						-moz-transform:translateY(-50%) translateX(0%) !important;
						-webkit-transform:translateY(-50%) translateX(0%) !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLine4 { width:80% !important; opacity:1 !important; }
					.TotPortHovLine5
					{
						position:absolute !important;
						width:0% !important;
						height:90% !important;
						border-top:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
						border-bottom:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
						top:50% !important;
						left:50% !important;
						opacity:0 !important;
						transform:translateY(-50%) translateX(-50%) !important;
						-ms-transform:translateY(-50%) translateX(-50%) !important;
						-moz-transform:translateY(-50%) translateX(-50%) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLine5 { width:80% !important; opacity:1 !important; }
					.TotPortHovLine6
					{
						position:absolute !important;
						width:120px !important;
						height:120px !important;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
						border-radius:50% !important;
						top:100% !important;
						left:100% !important;
						opacity:0 !important;
						transform:translateY(-50%) translateX(-50%) !important;
						-ms-transform:translateY(-50%) translateX(-50%) !important;
						-moz-transform:translateY(-50%) translateX(-50%) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLine6 { top:50% !important; left:50% !important; opacity:1 !important; }
					.TotPortHovLine7
					{
						position:absolute !important;
						width:0px !important;
						height:0px !important;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
						top:50% !important;
						left:50% !important;
						opacity:0 !important;
						transform:translateY(-50%) translateX(-50%) rotate(0deg) !important;
						-ms-transform:translateY(-50%) translateX(-50%) rotate(0deg) !important;
						-moz-transform:translateY(-50%) translateX(-50%) rotate(0deg) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(0deg) !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLine7
					{
						width:100px !important;
						height:100px !important;
						transform:translateY(-50%) translateX(-50%) rotate(45deg) !important;
						-ms-transform:translateY(-50%) translateX(-50%) rotate(45deg) !important;
						-moz-transform:translateY(-50%) translateX(-50%) rotate(45deg) !important;
						-webkit-transform:translateY(-50%) translateX(-50%) rotate(45deg) !important;
						opacity:1 !important;
					}
					.TotPortHovLink1
					{
						position:absolute !important;
						top:40% !important;
						left:50% !important;
						transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						font-size:0px;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?> !important;
						padding:5px 0px !important;
						text-align:center !important;
						opacity:1 !important;
						transition: all 0s linear !important;
						-webkit-transition: all 0s linear !important;
						-ms-transition: all 0s linear !important;
						-moz-transition: all 0s linear !important;
						-o-transition: all 0s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLink1
					{
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>px;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
					}
					.TotPortHovLink2
					{
						position:absolute !important;
						top:40% !important;
						left:50% !important;
						transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?> !important;
						padding:5px 0px !important;
						text-align:center !important;
						opacity:0 !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLink2 { opacity:1 !important; }
					.TotPortHovLink3
					{
						position:absolute !important;
						top:70% !important;
						left:5% !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?> !important;
						padding:5px 0px !important;
						text-align:center !important;
						opacity:0 !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLink3 { left:15% !important; opacity:1 !important; }
					.TotPortHovLink4
					{
						position:absolute !important;
						top:50% !important;
						left:90% !important;
						transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?> !important;
						padding:5px 0px !important;
						text-align:center !important;
						opacity:0 !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLink4 { left:50% !important; opacity:1 !important; }
					.TotPortHovLink5
					{
						position:absolute !important;
						top:80% !important;
						left:50% !important;
						transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>;
						font-size:0px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?> !important;
						padding:5px 0px !important;
						text-align:center !important;
						opacity:0 !important;
						transition: all 0s linear !important;
						-webkit-transition: all 0s linear !important;
						-ms-transition: all 0s linear !important;
						-moz-transition: all 0s linear !important;
						-o-transition: all 0s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLink5
					{
						top:50% !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>px;
						opacity:1 !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
					}
					.TotPortHovLink6
					{
						position:absolute !important;
						top:50% !important;
						left:40% !important;
						transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?> !important;
						padding:5px 0px !important;
						text-align:center !important;
						opacity:0 !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLink6 { left:50% !important; opacity:1 !important; }
					.TotPortHovLink7
					{
						position:relative !important;
						top:60% !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?> !important;
						padding:0px 7px !important;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						text-align:center !important;
						opacity:0 !important;
						perspective:800px !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLink7 { opacity:1 !important; }
					.TotPortHovLink8
					{
						position:absolute !important;
						top:-100% !important;
						left:50% !important;
						transform:translateX(-50%) !important;
						-ms-transform:translateX(-50%) !important;
						-moz-transform:translateX(-50%) !important;
						-webkit-transform:translateX(-50%) !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?> !important;
						padding:0px 7px !important;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						text-align:center !important;
						opacity:1 !important;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLink8 { opacity:1 !important; top:60% !important; }
					.TotPortHovLink9
					{
						position:relative !important;
						top:60% !important;
						font-family:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>;
						font-size:0px;
						color:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?> !important;
						padding:0px 7px !important;
						border:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						text-align:center !important;
						opacity:0 !important;
						transition: all 0s linear !important;
						-webkit-transition: all 0s linear !important;
						-ms-transition: all 0s linear !important;
						-moz-transition: all 0s linear !important;
						-o-transition: all 0s linear !important;
					}
					.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li:hover .TotPortHovLink9
					{
						opacity:1 !important;
						font-size:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>px;
						transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-webkit-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-ms-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-moz-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
						-o-transition: all <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32/10;?>s linear !important;
					}
					.TotPortHovLink,.TotPortHovLink:hover { text-decoration:none !important; }
					.TotPortHovLink:focus { border:none; outline: none !important; }
				</style>
				<div class="totalsoft-TS_Portfolio_GAA_">
					<div class="totalsoft-portfolio-content">
						<ul class="totalsoft-portfolio-categ totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?> filter">
							<li class="all active<?php echo $Total_Soft_Portfolio;?>"><a href="#"><?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_19;?></a></li>
							<?php for($i=0;$i<count($TotalSoftPortfolioAlbums);$i++){ ?>
								<li class="portfolio-totalsoft-album<?php echo $Total_Soft_Portfolio; ?>-<?php echo $i;?>"><a href="#" title="<?php echo $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle;?>"><?php echo $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle;?></a></li>
							<?php }?>
						</ul>
						<ul class="totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?>" style='padding:0px;margin:0px;text-align:center;'>
							<?php for($i=0;$i<$TotalSoftPortfolioManager[0]->TotalSoftPortfolio_AlbumCount;$i++){
								$TSoftPort_ContPop_Images=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE TotalSoftPortfolio_IA = %s and Portfolio_ID = %s order by id", $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle, $Total_Soft_Portfolio));
									for($j=0;$j<count($TSoftPort_ContPop_Images);$j++){ ?>
										<li class="totalsoft-portfolio-item2<?php echo $Total_Soft_Portfolio; ?>" data-id="id<?php echo $Total_Soft_Portfolio; ?>-<?php echo $i . $j;?>" data-type="portfolio-totalsoft-album<?php echo $Total_Soft_Portfolio; ?>-<?php echo $i;?>">
											<div>
												<span class="totalsoft-image-block">
													<a class="totalsoft-image-zoom" href="<?php echo $TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IURL;?>" rel="TSprettyPhoto[gallery<?php echo $Total_Soft_Portfolio; ?>]" title="<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39=='true'){ echo html_entity_decode($TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IT);} ?>">
														<img class='TotPortImgOv <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?>' src="<?php echo $TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IURL;?>" alt="<?php echo html_entity_decode($TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IT);?>" title="<?php echo html_entity_decode($TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IT);?>" />
														<div class='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12;?>'></div>
														<h2 class='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>' >
															<?php echo html_entity_decode($TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IT);?>
														</h2>
														<div class='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>'></div>
														<?php if($TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_ILink != ''){ ?>
															<a href='<?php echo $TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_ILink;?>' class='TotPortHovLink <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>' <?php if($TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IONT=='true'){echo 'target="_blank"';}?>>
																<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>
															</a>
														<?php } ?>
													</a>
												</span>
											</div>
										</li>
							<?php }} ?>
							<div class="column-clear"></div>
						</ul>
					</div>
				</div>
				<input type='text' style='display:none;' class='NavMenuFS<?php echo $Total_Soft_Portfolio; ?>' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_25;?>'>
				<input type='text' style='display:none;' class='portImgWidth<?php echo $Total_Soft_Portfolio; ?>' value='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01;?>'>
				<input type='text' style='display:none;' class='portImgHeight<?php echo $Total_Soft_Portfolio; ?>' value='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01*3/4;?>'>
				<input type='text' style='display:none;' class='portTitFS<?php echo $Total_Soft_Portfolio; ?>' value='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>'>
				<input type='text' style='display:none;' class='portLinkFS<?php echo $Total_Soft_Portfolio; ?>' value='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>'>
				<input type='text' style='display:none;' class='portPoppTitleFS<?php echo $Total_Soft_Portfolio; ?>' value='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>'>
				<script>
					var NavMenuFS<?php echo $Total_Soft_Portfolio; ?>=jQuery('.NavMenuFS<?php echo $Total_Soft_Portfolio; ?>').val();
					var portImgWidth<?php echo $Total_Soft_Portfolio; ?>=jQuery('.portImgWidth<?php echo $Total_Soft_Portfolio; ?>').val();
					var portImgHeight<?php echo $Total_Soft_Portfolio; ?>=jQuery('.portImgHeight<?php echo $Total_Soft_Portfolio; ?>').val();
					var portTitFS<?php echo $Total_Soft_Portfolio; ?>=jQuery('.portTitFS<?php echo $Total_Soft_Portfolio; ?>').val();
					var portLinkFS<?php echo $Total_Soft_Portfolio; ?>=jQuery('.portLinkFS<?php echo $Total_Soft_Portfolio; ?>').val();
					var portPoppTitleFS<?php echo $Total_Soft_Portfolio; ?>=jQuery('.portPoppTitleFS<?php echo $Total_Soft_Portfolio; ?>').val();
					function resp<?php echo $Total_Soft_Portfolio; ?>(){
						jQuery('.tspp_description').animate('font-size',Math.ceil(portPoppTitleFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('#fullResImage').prop('naturalWidth')/(jQuery('#fullResImage').prop('naturalWidth')+150)));
						jQuery('.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?>').css('font-size',Math.ceil(NavMenuFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?>').width()/(jQuery('.totalsoft-portfolio-categ<?php echo $Total_Soft_Portfolio; ?>').width()+100)));
						if(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').parent().width()<=500)
						{
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').css('width',portImgWidth<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').parent().width()/500);
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').css('height',portImgHeight<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').parent().width()/500);
							for(i=1;i<=11;i++)
							{
								if(i==3 || i==10){ continue; }
								jQuery('.TotPortHovTit'+i).css('font-size',Math.ceil(portTitFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+100)));
							}
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').hover(function(){
								jQuery('.TotPortHovTit3').css({'font-size':Math.ceil(portTitFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+100))});
							},function(){ jQuery('.TotPortHovTit3').css({'font-size':'0px'}); })
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').hover(function(){
								jQuery('.TotPortHovTit10').css({'font-size':Math.ceil(portTitFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+100))});
							},function(){ jQuery('.TotPortHovTit10').css({'font-size':'0px'}); })
							for(i=1;i<=9;i++)
							{
								if(i==1 || i==5 || i==9){ continue; }
								jQuery('.TotPortHovLink'+i).css('font-size',Math.ceil(portLinkFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+100)));
							}
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').hover(function(){
								jQuery('.TotPortHovLink5').css({'font-size':Math.ceil(portLinkFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+100))});
							},function(){ jQuery('.TotPortHovLink5').css({'font-size':'0px'}); })
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').hover(function(){
								jQuery('.TotPortHovLink9').css({'font-size':Math.ceil(portLinkFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+100))});
							},function(){ jQuery('.TotPortHovLink9').css({'font-size':'0px'}); })
						}
						if(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').parent().width()<=300)
						{
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').css('width',jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').parent().width()-10);
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').css('height',jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()*3/4+'px');
							for(i=1;i<=11;i++)
							{
								if(i==3 || i==10){ continue; }
								jQuery('.TotPortHovTit'+i).css('font-size',Math.ceil(portTitFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+50)));
							}
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').hover(function(){
								jQuery('.TotPortHovTit3').css({'font-size':Math.ceil(portTitFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+50))});
							},function(){ jQuery('.TotPortHovTit3').css({'font-size':'0px'}); })
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').hover(function(){
								jQuery('.TotPortHovTit10').css({'font-size':Math.ceil(portTitFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+50))});
							},function(){ jQuery('.TotPortHovTit10').css({'font-size':'0px'}); })
							for(i=1;i<=9;i++)
							{
								if(i==1 || i==5 || i==9){ continue; }
								jQuery('.TotPortHovLink'+i).css('font-size',Math.ceil(portLinkFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+50)));
							}
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').hover(function(){
								jQuery('.TotPortHovLink5').css({'font-size':Math.ceil(portLinkFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+50))});
							},function(){ jQuery('.TotPortHovLink5').css({'font-size':'0px'}); })
							jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').hover(function(){
								jQuery('.TotPortHovLink9').css({'font-size':Math.ceil(portLinkFS<?php echo $Total_Soft_Portfolio; ?>*jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()/(jQuery('.totalsoft-portfolio-area<?php echo $Total_Soft_Portfolio; ?> li').width()+50))});
							},function(){ jQuery('.TotPortHovLink9').css({'font-size':'0px'}); })
						}
					}
					resp<?php echo $Total_Soft_Portfolio; ?>();
					jQuery(window).resize(function(){ resp<?php echo $Total_Soft_Portfolio; ?>(); })
				</script>
			<?php } else if($TotalSoftPortfolioOpt[0]->TotalSoftPortfolio_SetType == 'Slider Portfolio'){ ?>
				<link rel="stylesheet" type="text/css" media="all" href="<?php echo plugins_url('../CSS/jgallery.css?v=1.5.0',__FILE__);?>" />
				<style type="text/css">
					.TotalSoft_Slider_Port_<?php echo $Total_Soft_Portfolio;?>
					{
						position: relative;
						width: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?>%;
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05=='left'){ ?>
							float: left;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05=='right'){ ?>
							float: right;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05=='center'){ ?>
							margin: 0 auto;
						<?php }?>
						border: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?> <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>;
					}
					.jgallery[data-jgallery-id="<?php echo $Total_Soft_Portfolio;?>"] .zoom-container:not([data-size="fill"]) .jgallery-container,.jgallery .zoom .jgallery-container.pt-page-current:not(.pt-page-prev)
					{
						background: rgba(0,0,0,0) !important;
					}
					.jgallery .jgallery-btn-small
					{
						width: 40px;
						height: 40px;
						margin: 0;
						line-height: 43px;
						font-size: 18px;
						text-align: center;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
					}
					.jgallery-thumbnails { display:block !important; visibility: visible !important; }
					.nav-bottom { display:block !important; }
					.jgallery[data-jgallery-id="<?php echo $Total_Soft_Portfolio;?>"] .jgallery-thumbnails-horizontal { height:50px !important; }
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35=='image'){ ?>
						.jgallery[data-jgallery-id="<?php echo $Total_Soft_Portfolio;?>"] .jgallery-thumbnails a { height:100% !important; width:auto !important; }
						.jgallery[data-jgallery-id="<?php echo $Total_Soft_Portfolio;?>"] .jgallery-thumbnails a { width:auto !important; height:100% !important; }
					<?php } ?>
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34=='top'){ ?>
						.jgallery .zoom-container { margin-top:50px !important; }
					<?php } ?>
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34=='left'){ ?>
						.jgallery .zoom-container { margin-left:40px !important; height: calc(100% - 40px) !important; max-height: calc(100% - 40px) !important; }
						.jgallery[data-jgallery-id="<?php echo $Total_Soft_Portfolio;?>"] .jgallery-thumbnails-vertical { width:40px !important; }
					<?php } ?>
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34=='right'){ ?>
						.jgallery .zoom-container { margin-right:40px !important; height: calc(100% - 40px) !important; max-height: calc(100% - 40px) !important; }
						.jgallery[data-jgallery-id="<?php echo $Total_Soft_Portfolio;?>"] .jgallery-thumbnails-vertical { width:40px !important; }
					<?php } ?>
				</style>
				<script type="text/javascript" src="<?php echo plugins_url('../JS/touchswipe.min.js',__FILE__);?>"></script>
				<script type="text/javascript">
					jQuery(function(){ jQuery('#TotalSoft_Slider_PortGal_<?php echo $Total_Soft_Portfolio;?>').jGallery(); });
				</script>
				<div class="TotalSoft_Slider_Port_<?php echo $Total_Soft_Portfolio;?>">
					<div style="width: 100%; height: auto;">
						<div id="TotalSoft_Slider_PortGal_<?php echo $Total_Soft_Portfolio;?>">
							<?php for($i=0;$i<$TotalSoftPortfolioManager[0]->TotalSoftPortfolio_AlbumCount;$i++){
								$TSoftPort_ContPop_Images=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE TotalSoftPortfolio_IA = %s and Portfolio_ID = %s order by id", $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle, $Total_Soft_Portfolio));
								?>
								<div class="album" data-jgallery-album-title="<?php echo $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle;?>">
									<?php for($j=0;$j<count($TSoftPort_ContPop_Images);$j++){ ?>
										<a href="<?php echo $TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IURL;?>"><img src="<?php echo $TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IURL;?>" alt="<?php echo html_entity_decode($TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IT);?>" /></a>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<script>
					jQuery(document).ready(function(){
						function resp(){
							jQuery('.jgallery-standard').css('height',<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>*jQuery('.jgallery-standard').width()/(jQuery('.jgallery-standard').width()+350));
							jQuery('.pt-item').css('height',<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>*jQuery('.jgallery-standard').width()/(jQuery('.jgallery-standard').width()+350)-80);
						}
						function titResp(){
							if(jQuery('.jgallery-standard').width()<=400){ jQuery('span.title').css('display','none'); }else{ jQuery('span.title').css('display','inline-block'); }
						}
						jQuery(window).load(function(){ resp(); })
						jQuery(window).resize(function(){ titResp(); })
						var count=0;
						jQuery('.change-mode').click(function(){
							if(count==1)
							{
								resp();
								jQuery('.pt-item').css('height',<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>*jQuery('.jgallery-standard').width()/(jQuery('.jgallery-standard').width()+350)-80);
							}
							else if(count==2){ count=0; }
							count++;
						})
					})
				</script>
				<script type="text/javascript">
					( function() {
						"use strict";
					var defaults = {
						autostart: true,
						autostartAtImage: 1,
						autostartAtAlbum: 1,
						backgroundColor: '#ff0000',
						browserHistory: true,
						canChangeMode: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39;?>,
						canClose: false,
						canMinimalizeThumbnails: false,
						canZoom: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?>,
						disabledOnIE8AndOlder: true,
						draggableZoom: true,
						draggableZoomHideNavigationOnMobile: true,
						height: '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>px',
						hideThumbnailsOnInit: false,
						maxMobileWidth: 767,
						mode: 'standard',
						preloadAll: false,
						slideshow: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?>,
						slideshowAutostart: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01;?>,
						slideshowCanRandom: false,
						slideshowInterval: '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02;?>s',
						slideshowRandom: false,
						swipeEvents: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>,
						textColor: '#ff0000',
						thumbnails: false,
						thumbHeight: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>,
						thumbHeightOnFullScreen: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>,
						thumbnailsFullScreen: true,
						thumbnailsHideOnMobile: true,
						thumbnailsPosition: '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34;?>',
						thumbType: '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?>',
						thumbWidth: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>,
						thumbWidthOnFullScreen: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>,
						title: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>,
						titleExpanded: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>,
						tooltipClose: 'Close',
						tooltipFullScreen: 'Full screen',
						tooltipRandom: 'Random',
						tooltips: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?>,
						tooltipSeeAllPhotos: 'See all photos',
						tooltipSeeOtherAlbums: 'See other albums',
						tooltipSlideshow: 'Slideshow',
						tooltipToggleThumbnails: 'Toggle thumbnails',
						tooltipZoom: 'Zoom',
						transition: '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>',
						transitionBackward: '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>',
						transitionCols: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12;?>,
						transitionDuration: '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14;?>s',
						transitionRows: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>,
						transitionTimingFunction: 'cubic-bezier(0,1,1,1)',
						transitionWaveDirection: 'forward',
						width: '100%',
						zoomSize: 'fit',
						afterLoadPhoto: function() {},
						beforeLoadPhoto: function() {},
						closeGallery: function() {},
						initGallery: function() {},
						showGallery: function() {},
						showPhoto: function() {}
					};
					var defaultsFullScreenMode = {};
					var defaultsSliderMode = {
						width: '940px',
						height: '360px',
						canZoom: false,
						draggableZoom: false,
						browserHistory: false,
						thumbnailsFullScreen: false,
						thumbType: 'square',
						thumbWidth: 20, //px
						thumbHeight: 20, //px
						canMinimalizeThumbnails: false,
						transition: 'rotateCubeRightOut_rotateCubeRightIn',
						transitionBackward: 'rotateCubeRightOut_rotateCubeRightIn',
						transitionCols: 6,
						transitionRows: 1,
						slideshow: true,
						slideshowAutostart: true,
						zoomSize: 'fill'
					};
					var requiredFullScreenMode = {};
					var requiredSliderMode = {
						autostart: true,
						canClose: false,
						zoomSize: 'fill',
						canChangeMode: false
					};
					var jGalleryTransitions = {
						moveToLeft_moveFromRight: ["pt-page-moveToLeft","pt-page-moveFromRight"],
						moveToRight_moveFromLeft: ["pt-page-moveToRight","pt-page-moveFromLeft"],
						moveToTop_moveFromBottom: ["pt-page-moveToTop","pt-page-moveFromBottom"],
						moveToBottom_moveFromTop: ["pt-page-moveToBottom","pt-page-moveFromTop"],
						fade_moveFromRight: ["pt-page-fade","pt-page-moveFromRight pt-page-ontop"],
						fade_moveFromLeft: ["pt-page-fade","pt-page-moveFromLeft pt-page-ontop"],
						fade_moveFromBottom: ["pt-page-fade","pt-page-moveFromBottom pt-page-ontop"],
						fade_moveFromTop: ["pt-page-fade","pt-page-moveFromTop pt-page-ontop"],
						moveToLeftFade_moveFromRightFade: ["pt-page-moveToLeftFade","pt-page-moveFromRightFade"],
						moveToRightFade_moveFromLeftFade: ["pt-page-moveToRightFade","pt-page-moveFromLeftFade"],
						moveToTopFade_moveFromBottomFade: ["pt-page-moveToTopFade","pt-page-moveFromBottomFade"],
						moveToBottomFade_moveFromTopFade: ["pt-page-moveToBottomFade","pt-page-moveFromTopFade"],
						moveToLeftEasing_moveFromRight: ["pt-page-moveToLeftEasing pt-page-ontop","pt-page-moveFromRight"],
						moveToRightEasing_moveFromLeft: ["pt-page-moveToRightEasing pt-page-ontop","pt-page-moveFromLeft"],
						moveToTopEasing_moveFromBottom: ["pt-page-moveToTopEasing pt-page-ontop","pt-page-moveFromBottom"],
						moveToBottomEasing_moveFromTop: ["pt-page-moveToBottomEasing pt-page-ontop","pt-page-moveFromTop"],
						scaleDown_moveFromRight: ["pt-page-scaleDown","pt-page-moveFromRight pt-page-ontop"],
						scaleDown_moveFromLeft: ["pt-page-scaleDown","pt-page-moveFromLeft pt-page-ontop"],
						scaleDown_moveFromBottom: ["pt-page-scaleDown","pt-page-moveFromBottom pt-page-ontop"],
						scaleDown_moveFromTop: ["pt-page-scaleDown","pt-page-moveFromTop pt-page-ontop"],
						scaleDown_scaleUpDown: ["pt-page-scaleDown","pt-page-scaleUpDown pt-page-delay300"],
						scaleDownUp_scaleUp: ["pt-page-scaleDownUp","pt-page-scaleUp pt-page-delay300"],
						moveToLeft_scaleUp: ["pt-page-moveToLeft pt-page-ontop","pt-page-scaleUp"],
						moveToRight_scaleUp: ["pt-page-moveToRight pt-page-ontop","pt-page-scaleUp"],
						moveToTop_scaleUp: ["pt-page-moveToTop pt-page-ontop","pt-page-scaleUp"],
						moveToBottom_scaleUp: ["pt-page-moveToBottom pt-page-ontop","pt-page-scaleUp"],
						scaleDownCenter_scaleUpCenter: ["pt-page-scaleDownCenter","pt-page-scaleUpCenter pt-page-delay400"],
						rotateRightSideFirst_moveFromRight: ["pt-page-rotateRightSideFirst","pt-page-moveFromRight pt-page-delay200 pt-page-ontop"],
						rotateLeftSideFirst_moveFromLeft: ["pt-page-rotateLeftSideFirst","pt-page-moveFromLeft pt-page-delay200 pt-page-ontop"],
						rotateTopSideFirst_moveFromTop: ["pt-page-rotateTopSideFirst","pt-page-moveFromTop pt-page-delay200 pt-page-ontop"],
						rotateBottomSideFirst_moveFromBottom: ["pt-page-rotateBottomSideFirst","pt-page-moveFromBottom pt-page-delay200 pt-page-ontop"],
						flipOutRight_flipInLeft: ["pt-page-flipOutRight","pt-page-flipInLeft pt-page-delay500"],
						flipOutLeft_flipInRight: ["pt-page-flipOutLeft","pt-page-flipInRight pt-page-delay500"],
						flipOutTop_flipInBottom: ["pt-page-flipOutTop","pt-page-flipInBottom pt-page-delay500"],
						flipOutBottom_flipInTop: ["pt-page-flipOutBottom","pt-page-flipInTop pt-page-delay500"],
						rotateFall_scaleUp: ["pt-page-rotateFall pt-page-ontop","pt-page-scaleUp"],
						rotateOutNewspaper_rotateInNewspaper: ["pt-page-rotateOutNewspaper","pt-page-rotateInNewspaper pt-page-delay500"],
						rotatePushLeft_moveFromRight: ["pt-page-rotatePushLeft","pt-page-moveFromRight"],
						rotatePushRight_moveFromLeft: ["pt-page-rotatePushRight","pt-page-moveFromLeft"],
						rotatePushTop_moveFromBottom: ["pt-page-rotatePushTop","pt-page-moveFromBottom"],
						rotatePushBottom_moveFromTop: ["pt-page-rotatePushBottom","pt-page-moveFromTop"],
						rotatePushLeft_rotatePullRight: ["pt-page-rotatePushLeft","pt-page-rotatePullRight pt-page-delay180"],
						rotatePushRight_rotatePullLeft: ["pt-page-rotatePushRight","pt-page-rotatePullLeft pt-page-delay180"],
						rotatePushTop_rotatePullBottom: ["pt-page-rotatePushTop","pt-page-rotatePullBottom pt-page-delay180"],
						rotatePushBottom_page: ["pt-page-rotatePushBottom","pt-page-rotatePullTop pt-page-delay180"],
						rotateFoldLeft_moveFromRightFade: ["pt-page-rotateFoldLeft","pt-page-moveFromRightFade"],
						rotateFoldRight_moveFromLeftFade: ["pt-page-rotateFoldRight","pt-page-moveFromLeftFade"],
						rotateFoldTop_moveFromBottomFade: ["pt-page-rotateFoldTop","pt-page-moveFromBottomFade"],
						rotateFoldBottom_moveFromTopFade: ["pt-page-rotateFoldBottom","pt-page-moveFromTopFade"],
						moveToRightFade_rotateUnfoldLeft: ["pt-page-moveToRightFade","pt-page-rotateUnfoldLeft"],
						moveToLeftFade_rotateUnfoldRight: ["pt-page-moveToLeftFade","pt-page-rotateUnfoldRight"],
						moveToBottomFade_rotateUnfoldTop: ["pt-page-moveToBottomFade","pt-page-rotateUnfoldTop"],
						moveToTopFade_rotateUnfoldBottom: ["pt-page-moveToTopFade","pt-page-rotateUnfoldBottom"],
						rotateRoomLeftOut_rotateRoomLeftIn: ["pt-page-rotateRoomLeftOut pt-page-ontop","pt-page-rotateRoomLeftIn"],
						rotateRoomRightOut_rotateRoomRightIn: ["pt-page-rotateRoomRightOut pt-page-ontop","pt-page-rotateRoomRightIn"],
						rotateRoomTopOut_rotateRoomTopIn: ["pt-page-rotateRoomTopOut pt-page-ontop","pt-page-rotateRoomTopIn"],
						rotateRoomBottomOut_rotateRoomBottomIn: ["pt-page-rotateRoomBottomOut pt-page-ontop","pt-page-rotateRoomBottomIn"],
						rotateCubeLeftOut_rotateCubeLeftIn: ["pt-page-rotateCubeLeftOut pt-page-ontop","pt-page-rotateCubeLeftIn"],
						rotateCubeRightOut_rotateCubeRightIn: ["pt-page-rotateCubeRightOut pt-page-ontop","pt-page-rotateCubeRightIn"],
						rotateCubeTopOut_rotateCubeTopIn: ["pt-page-rotateCubeTopOut pt-page-ontop","pt-page-rotateCubeTopIn"],
						rotateCubeBottomOut_rotateCubeBottomIn: ["pt-page-rotateCubeBottomOut pt-page-ontop","pt-page-rotateCubeBottomIn"],
						rotateCarouselLeftOut_rotateCarouselLeftIn: ["pt-page-rotateCarouselLeftOut pt-page-ontop","pt-page-rotateCarouselLeftIn"],
						rotateCarouselRightOut_rotateCarouselRightIn: ["pt-page-rotateCarouselRightOut pt-page-ontop","pt-page-rotateCarouselRightIn"],
						rotateCarouselTopOut_rotateCarouselTopIn: ["pt-page-rotateCarouselTopOut pt-page-ontop","pt-page-rotateCarouselTopIn"],
						rotateCarouselBottomOut_rotateCarouselBottomIn: ["pt-page-rotateCarouselBottomOut pt-page-ontop","pt-page-rotateCarouselBottomIn"],
						rotateSidesOut_rotateSidesInDelay: ["pt-page-rotateSidesOut","pt-page-rotateSidesIn pt-page-delay200"],
						rotateSlideOut_rotateSlideIn: ["pt-page-rotateSlideOut","pt-page-rotateSlideIn"]
					};
					var jGalleryArrayTransitions = ( function( jGalleryTransitions ) {
						var $ = jQuery;
						var jGalleryArrayTransitions = [];
						$.each( jGalleryTransitions, function( index, value ) { jGalleryArrayTransitions.push( value ); } );
						return jGalleryArrayTransitions;
					} )( jGalleryTransitions );
					var jGalleryBackwardTransitions = {
						moveToLeft_moveFromRight: 'moveToRight_moveFromLeft',
						moveToRight_moveFromLeft: 'moveToLeft_moveFromRight',
						moveToTop_moveFromBottom: 'moveToBottom_moveFromTop',
						moveToBottom_moveFromTop: 'moveToTop_moveFromBottom',
						fade_moveFromRight: 'fade_moveFromLeft',
						fade_moveFromLeft: 'fade_moveFromRight',
						fade_moveFromBottom: 'fade_moveFromTop',
						fade_moveFromTop: 'fade_moveFromBottom',
						moveToLeftFade_moveFromRightFade: 'moveToRightFade_moveFromLeftFade',
						moveToRightFade_moveFromLeftFade: 'moveToLeftFade_moveFromRightFade',
						moveToTopFade_moveFromBottomFade: 'moveToBottomFade_moveFromTopFade',
						moveToBottomFade_moveFromTopFade: 'moveToTopFade_moveFromBottomFade',
						moveToLeftEasing_moveFromRight: 'moveToRightEasing_moveFromLeft',
						moveToRightEasing_moveFromLeft: 'moveToLeftEasing_moveFromRight',
						moveToTopEasing_moveFromBottom: 'moveToBottomEasing_moveFromTop',
						moveToBottomEasing_moveFromTop: 'moveToTopEasing_moveFromBottom',
						scaleDown_moveFromRight: 'scaleDown_moveFromLeft',
						scaleDown_moveFromLeft: 'scaleDown_moveFromRight',
						scaleDown_moveFromBottom: 'scaleDown_moveFromTop',
						scaleDown_moveFromTop: 'scaleDown_moveFromBottom',
						scaleDown_scaleUpDown: 'scaleDownUp_scaleUp',
						scaleDownUp_scaleUp: 'scaleDown_scaleUpDown',
						moveToLeft_scaleUp: 'moveToRight_scaleUp',
						moveToRight_scaleUp: 'moveToLeft_scaleUp',
						moveToTop_scaleUp: 'moveToBottom_scaleUp',
						moveToBottom_scaleUp: 'moveToTop_scaleUp',
						scaleDownCenter_scaleUpCenter: 'scaleDownCenter_scaleUpCenter',
						rotateRightSideFirst_moveFromRight: 'rotateLeftSideFirst_moveFromLeft',
						rotateLeftSideFirst_moveFromLeft: 'rotateRightSideFirst_moveFromRight',
						rotateTopSideFirst_moveFromTop: 'rotateBottomSideFirst_moveFromBottom',
						rotateBottomSideFirst_moveFromBottom: 'rotateTopSideFirst_moveFromTop',
						flipOutRight_flipInLeft: 'flipOutLeft_flipInRight',
						flipOutLeft_flipInRight: 'flipOutRight_flipInLeft',
						flipOutTop_flipInBottom: 'flipOutBottom_flipInTop',
						flipOutBottom_flipInTop: 'flipOutTop_flipInBottom',
						rotateFall_scaleUp: 'rotateFall_scaleUp',
						rotateOutNewspaper_rotateInNewspaper: 'rotateOutNewspaper_rotateInNewspaper',
						rotatePushLeft_moveFromRight: 'rotatePushRight_moveFromLeft',
						rotatePushRight_moveFromLeft: 'rotatePushLeft_moveFromRight',
						rotatePushTop_moveFromBottom: 'rotatePushBottom_moveFromTop',
						rotatePushBottom_moveFromTop: 'rotatePushTop_moveFromBottom',
						rotatePushLeft_rotatePullRight: 'rotatePushRight_rotatePullLeft',
						rotatePushRight_rotatePullLeft: 'rotatePushLeft_rotatePullRight',
						rotatePushTop_rotatePullBottom: 'rotatePushTop_rotatePullBottom',
						rotatePushBottom_page: 'rotatePushBottom_page',
						rotateFoldLeft_moveFromRightFade: 'rotateFoldRight_moveFromLeftFade',
						rotateFoldRight_moveFromLeftFade: 'rotateFoldLeft_moveFromRightFade',
						rotateFoldTop_moveFromBottomFade: 'rotateFoldBottom_moveFromTopFade',
						rotateFoldBottom_moveFromTopFade: 'rotateFoldTop_moveFromBottomFade',
						moveToRightFade_rotateUnfoldLeft: 'moveToLeftFade_rotateUnfoldRight',
						moveToLeftFade_rotateUnfoldRight: 'moveToRightFade_rotateUnfoldLeft',
						moveToBottomFade_rotateUnfoldTop: 'moveToTopFade_rotateUnfoldBottom',
						moveToTopFade_rotateUnfoldBottom: 'moveToBottomFade_rotateUnfoldTop',
						rotateRoomLeftOut_rotateRoomLeftIn: 'rotateRoomRightOut_rotateRoomRightIn',
						rotateRoomRightOut_rotateRoomRightIn: 'rotateRoomLeftOut_rotateRoomLeftIn',
						rotateRoomTopOut_rotateRoomTopIn: 'rotateRoomBottomOut_rotateRoomBottomIn',
						rotateRoomBottomOut_rotateRoomBottomIn: 'rotateRoomTopOut_rotateRoomTopIn',
						rotateCubeLeftOut_rotateCubeLeftIn: 'rotateCubeRightOut_rotateCubeRightIn',
						rotateCubeRightOut_rotateCubeRightIn: 'rotateCubeLeftOut_rotateCubeLeftIn',
						rotateCubeTopOut_rotateCubeTopIn: 'rotateCubeBottomOut_rotateCubeBottomIn',
						rotateCubeBottomOut_rotateCubeBottomIn: 'rotateCubeTopOut_rotateCubeTopIn',
						rotateCarouselLeftOut_rotateCarouselLeftIn: 'rotateCarouselRightOut_rotateCarouselRightIn',
						rotateCarouselRightOut_rotateCarouselRightIn: 'rotateCarouselLeftOut_rotateCarouselLeftIn',
						rotateCarouselTopOut_rotateCarouselTopIn: 'rotateCarouselBottomOut_rotateCarouselBottomIn',
						rotateCarouselBottomOut_rotateCarouselBottomIn: 'rotateCarouselTopOut_rotateCarouselTopIn',
						rotateSidesOut_rotateSidesInDelay: 'rotateSidesOut_rotateSidesInDelay',
						rotateSlideOut_rotateSlideIn: 'rotateSlideOut_rotateSlideIn'
					};
					var outerHtml = function(){
						return (!this.length) ? this : (this[0].outerHTML || (
						function(el){
							var div = document.createElement('div');
							div.appendChild(el.cloneNode(true));
							var contents = div.innerHTML;
							div = null;
							return contents;
						})(this[0]));
					};
					var overlay = ( function() {
						var $ = jQuery;
						return function( options ) {
							var defaults = {
								'show': false,
								'hide': false,
								'showLoader': false,
								'hideLoader': false,
								'showProgress': false,
								'hideProgress': false,
								'resetProgress': false,
								'fadeIn': true,
								'fadeOut': true,
								'fadeInLoader': true,
								'fadeOutLoader': true,
								'afterInit': function() {}
							};
							options = $.extend( {}, defaults, options );
							this.each( function() {
								var
									$this = $( this ),
									$overlay,
									$imageLoader,
									$progress,
									$spinner,
									boolInitialized = $this.is( '.overlayContainer:has(.overlay)' ),
									showOverlay = function() { options.fadeIn ? $overlay.fadeIn( 500 ) : $overlay.show(); },
									hideOverlay = function() { options.fadeOut ? $overlay.fadeOut( 500 ) : $overlay.hide(); },
									showLoader = function() { options.fadeInLoader ? $imageLoader.not( ':visible' ).fadeIn( 500 ) : $imageLoader.not( ':visible' ).show(); },
									hideLoader = function() { options.fadeOutLoader ? $imageLoader.filter( ':visible' ).fadeOut( 500 ) : $imageLoader.filter( ':visible' ).hide(); };
								//init
								if ( ! boolInitialized )
								{
									$this.addClass( 'overlayContainer' );
									$this.append( '<span class="overlay" style="display: none;"><span class="imageLoaderPositionAbsolute" style="display: none;"><span class="totalsoft totalsoft-spin totalsoft-spinner"></span><span class="progress-value" style="display: none;">0</span></span></span>' );
									options.afterInit();
								}
								$overlay = $this.children( '.overlay' );
								$imageLoader = $this.find( '.imageLoaderPositionAbsolute' );
								$progress = $imageLoader.find( '.progress-value' );
								$spinner = $imageLoader.find( '.totalsoft-spinner' );
								if ( options.resetProgress ) { $progress.html( '0' ); }
								if ( options.showProgress ) { $imageLoader.addClass( 'preloadAll' ); $progress.show(); $spinner.hide(); }
								else if ( options.hideProgress ) { $imageLoader.removeClass( 'preloadAll' ); $progress.hide(); $spinner.show(); }
								$overlay.stop( false, true );
								$imageLoader.stop( false, true );
								if ( options.show ) { showOverlay(); } else if ( options.hide ) { hideOverlay(); }
								if ( options.showLoader ) { showLoader(); } else if ( options.hideLoader ) { hideLoader(); }
								//endinit
							} );
						};
					} )();
					var jLoader = ( function( overlay ) {
						var $ = jQuery;
						$.fn.overlay = overlay;
						return function( options ) {
							options = $.extend( {
								interval: 1000,
								skip: ':not(*)',
								start: function() { $( 'body' ).overlay( { 'fadeIn': false, 'fadeOut': false, 'show': true, 'showLoader': true } ); $( 'body' ).show(); },
								success: function() { $( 'body' ).overlay( { 'hide': true } ); },
								progress: function() { }
							}, options );
							this.each( function() {
								var $this = $( this );
								var $tmp = $();
								var $images = $();
								var timeout;
								var intCount = 0;
								function check() {
									var boolComplete = true;
									var intComplete = 0;
									var intPercent;
									$images.each( function() { if ( $( this )[0].complete && $( this )[0].naturalWidth > 0 ) { intComplete++; } else { boolComplete = false; } } );
									intPercent = parseInt( intComplete * 100 / intCount );
									options.progress( { percent: intPercent } );
									if ( boolComplete ) { clearTimeout( timeout ); $tmp.remove(); options.success(); } else { timeout = setTimeout( check, options.interval ); }
								}
								$this.append( '<div class="jLoaderTmp" style="position: absolute; width: 0; height: 0; line-height: 0; font-size: 0; visibility: hidden; overflow: hidden; z-index: -1;"></div>' );
								$tmp = $this.children( '.jLoaderTmp:last-child' );
								$( $this ).add( $this.find( '*' ) ).not( options.skip ).each( function() {
									var strBackgroundUrl;
									if ( $( this ).css( 'background-image' ) !== 'none' )
									{
										strBackgroundUrl = $( this ).css( 'background-image' );
										if ( /url/.exec( strBackgroundUrl ) ) 
										{
											strBackgroundUrl = strBackgroundUrl.replace( '"', '' ).replace( "'", '' ).replace( ' ', '' ).replace( 'url(', '' ).replace( ')', '' );
											$tmp.append( '<img src="' + strBackgroundUrl + '">' );
										}
									}
								} );
								$images = $this.find( 'img:not( ' + options.skip + ')' );
								if ( $this.is( 'img' ) ) { if ( ! $this.is( options.skip ) ) { $images = $images.add( $this ); } }
								intCount = parseInt( $images.length );
								options.start();
								check();
							} );
						};
					} )( overlay );
					var historyPushState = ( function() {
						var $ = jQuery;
						var $title = $( 'title' );
						return function( options ) {
							options = $.extend( {}, { stateObj: {}, title: $title.html(), path: '' }, options );
							window.history.pushState( options.stateObj, options.title, document.location.href.split('#')[0] + '#' + options.path );
						};
					} )();
					var isInternetExplorer = function() {
						var rv = false;
						if ( navigator.appName === 'Microsoft Internet Explorer' )
						{
							var ua = navigator.userAgent;
							var re = new RegExp( "MSIE ([0-9]{1,}[\.0-9]{0,})" );
							if ( re.exec(ua) !== null ) { rv = true; }
						}
						return rv;
					};
					var isInternetExplorer8AndOlder = function() {
						var rv = false;
						if ( navigator.appName === 'Microsoft Internet Explorer' )
						{
							var ua = navigator.userAgent;
							var re = new RegExp( "MSIE ([0-9]{1,}[\.0-9]{0,})" );
							if ( re.exec(ua) !== null ) { rv = parseFloat( RegExp.$1 ); rv = rv < 9; }
						}
						return rv;
					};
					var refreshHTMLClasses = function() {
						var $ = jQuery;
						var $html = $( 'html' );
						return function() {
							$html.find( '.jgallery' ).length === 0 ? $html.removeClass( 'has-jgallery' ) : $html.addClass( 'has-jgallery' );
							$html.find( '.jgallery.hidden' ).length === 0 ? $html.removeClass( 'has-hidden-jgallery' ) : $html.addClass( 'has-hidden-jgallery' );
							$html.find( '.jgallery:not(.hidden)' ).length === 0 ? $html.removeClass( 'has-visible-jgallery' ) : $html.addClass( 'has-visible-jgallery' );
						};
					};
					var AdvancedAnimation = ( function( isInternetExplorer8AndOlder ) {
						var $ = jQuery;
						var $head = $( 'head' );
						var intAdvancedAnimationLastId = <?php echo $Total_Soft_Portfolio;?>;
						var AdvancedAnimation = function( $this ) {
							if ( $this.is( '[data-advanced-animation-id]') ) { return; }
							this.cols = 1;
							this.rows = 1;
							this.direction = 'forward';
							this.animation = true;
							this.$element = $this;
							this.$element.filter( ':not( [data-advanced-animation-id] )' ).attr( 'data-advanced-animation-id', intAdvancedAnimationLastId );
							this.$element.find( '.pt-item' ).wrap( '<div class="pt-page" />' );
							this.$element.wrapInner( '<div class="pt-part" />' );
							this.generateHtml();
							this._showParts( this.$element.find( '.pt-part' ), 1 );
						};
						AdvancedAnimation.prototype = {
							next: function() {
								var $next = this.$element.find( '.pt-part' ).eq( this.direction === 'backward' ? -1 : 0 ).find( '.pt-page-current:not(.pt-page-prev)' ).next();
								if ( $next.length ) { this.show( $next ); }
								else { this.show( this.$element.find( '.pt-part' ).eq( this.direction === 'backward' ? -1 : 0 ).find( '.pt-page' ).eq( 0 ) ); }
							},
							show: function( $new, options ) {
								var intPtPageNumber = $new.prevAll().length + 1;
								if ( $new.is( '.pt-page-current:not(.pt-page-prev)' ) ) { return; }
								options = $.extend( {}, { animation: true }, options );
								this.animation = options.animation;
								this._waveJumpToEnd();
								if ( this.animation ) { this._runWave( intPtPageNumber ); } else { this._showParts( this.$element.find( '.pt-part' ), intPtPageNumber ); }
								this.intPrevPtPageNumber = intPtPageNumber;
							},
							setQuantityParts: function( intCols, intRows ) {
								this.cols = intCols;
								this.rows = intRows;
								this.generateHtml();
							},
							setAnimationProperties: function( options ) {
								var intId = this.$element.attr( 'data-advanced-animation-id' );
								var $stylesheet = $head.find( 'style[data-advanced-animation-id="' + intId + '"]' );
								this.duration = options.duration;
								if ( isInternetExplorer8AndOlder() ) { return; }
								if ( $stylesheet.length === 0 ) { $stylesheet = $head.append( '<style type="text/css" data-advanced-animation-id="' + intId + '" />' ).children( ':last-child' ); }
								$stylesheet.html('\
									[data-advanced-animation-id="' + intId + '"] .pt-page {\
										-webkit-animation-duration: ' + options.duration + ';\
										-moz-animation-duration: ' + options.duration + ';\
										animation-duration: ' + options.duration + ';\
										-webkit-animation-timing-function: ' + options.transitionTimingFunction + ';\
										-moz-animation-timing-function: ' + options.transitionTimingFunction + ';\
										animation-timing-function: ' + options.transitionTimingFunction + ';\
									}\
								');
							},
							setHideEffect: function( hideEffect ) {
								this.prevHideEffect = this.hideEffect;
								this.hideEffect = hideEffect;
								if ( /moveTo|rotateRoom|rotateCarousel|rotateSlideOut/.test( hideEffect ) ) { this.$element.find( '.pt-part' ).addClass( 'hide-overflow' ); }
								else { this.$element.find( '.pt-part' ).removeClass( 'hide-overflow' ); }
							},
							setShowEffect: function( showEffect ) { this.prevShowEffect = this.showEffect; this.showEffect = showEffect; },
							setDirection: function( direction ) { this.direction = direction; },
							_runWave: function( intPtPageNumber ) { this.$element.find( '.pt-part' ).addClass( 'in-queue' ); this._showNextPart( intPtPageNumber ); },
							_waveJumpToEnd: function() {
								clearTimeout( this.showPartsTimeout );
								if ( typeof this.intPrevPtPageNumber !== 'undefined' )
								{
									this._showParts( this.$element.find( '.pt-part.in-queue' ).removeClass( 'in-queue' ), this.intPrevPtPageNumber );
								}
							},
							_showNextPart: function( intPtPageNumber ) {
								var self = this;
								var $part = this.$element.find( '.pt-part.in-queue' ).eq( this.direction === 'backward' ? -1 : 0 );
								if ( $part.length === 0 ) { return; }
								this._showParts( $part.removeClass( 'in-queue' ), intPtPageNumber );
								if ( $part.length === 0 ) { return; }
								clearTimeout( this.showPartsTimeout );
								this.showPartsTimeout = setTimeout( function() {
									self._showNextPart( intPtPageNumber );
								}, parseFloat( this.duration ) * 1000 * 0.25 / Math.max( 1, this.$element.find( '.pt-part' ).length - 1 ) );
							},
							_showParts: function( $this, intPtPageNumber ) {
								$this.find( '.pt-page-current.pt-page-prev' ).removeClass( 'pt-page-prev' ).removeClass( 'pt-page-current' );
								$this.find( '.pt-page-current' ).addClass( 'pt-page-prev' );
								$this.find( '.pt-page:nth-child(' + intPtPageNumber + ')' ).addClass( 'pt-page-current' );
								$this.find( '.pt-page' ).removeClass( this.hideEffect ).removeClass( this.showEffect );
								if ( typeof this.prevHideEffect !== 'undefined' ) { $this.find( '.pt-page' ).removeClass( this.prevHideEffect ); }
								if ( typeof this.prevShowEffect !== 'undefined' ) { $this.find( '.pt-page' ).removeClass( this.prevShowEffect ); }
								if ( this.animation ) 
								{
									$this.find( '.pt-page-prev' ).addClass( this.hideEffect );
									$this.find( '.pt-page-current:not(.pt-page-prev)' ).addClass( this.showEffect );
								}
							},
							hideActive: function() {
								this.$element.find( '.pt-page-current' ).addClass( 'pt-page-prev' ).addClass( this.hideEffect );
							},
							generateHtml: function() {
								var intI;
								var intJ;
								var $content;
								this.$element.html( this.$element.find( '.pt-part' ).eq( 0 ).html() );
								$content = this.$element.html();
								this.$element.children( '.pt-part' ).remove();
								for ( intJ = 0; intJ < this.rows; intJ++ )
								{
									for ( intI = 0; intI < this.cols; intI++ )
									{
										this.$element
											.append( '<div class="pt-part pt-perspective" data-col-no="' + intI + '" data-row-no="' + intJ + '" style="position: absolute;"></div>' )
											.children( ':last-child' )
											.html( $content )
											.find( '.pt-item' );
									}
								}
								this.setPositionParts();
								this.$element.children( ':not(.pt-part)' ).remove();
							},
							setPositionParts: function() {
								var self = this;
								var intWidth = this.$element.outerWidth();
								var intHeight = this.$element.outerHeight();
								var intPartWidth = intWidth / this.cols;
								var intPartHeight = intHeight / this.rows;
								this.$element.find( '.pt-part' ).each( function() {
									var $this = $( this );
									var intI = $this.attr( 'data-col-no' );
									var intJ = $this.attr( 'data-row-no' );
									this
									.css( {
										left: self.$element.outerWidth() * ( 100 / self.cols * intI ) / 100 + 'px',
										top: self.$element.outerHeight() * ( 100 / self.rows * intJ ) / 100 + 'px',
										width: self.$element.outerWidth() * ( 100 / self.cols ) / 100 + 1 + 'px',
										height: self.$element.outerHeight() * ( 100 / self.rows ) / 100 + 1 + 'px'
									} )
									.find( '.pt-item' )
									.css( {
										width: intWidth,
										height:jQuery('.jgallery').height()-80,
										left: - intPartWidth * intI,
										top: - intPartHeight * intJ
									} );
								} );
							}
						};
						return AdvancedAnimation;
					} )( isInternetExplorer8AndOlder );
					var IconChangeAlbum = ( function() {
						var $ = jQuery;
						var $html = $( 'html' );
						var IconChangeAlbum = function( $this, jGallery ) {
							this.$element = $this;
							this.jGallery = jGallery;
							this.$title = this.$element.find( '.title' );
						};
						IconChangeAlbum.prototype = {
							bindEvents: function( jGallery ) {
								var self = this;
								this.getElement().on( { click: function( event ) { self.menuToggle(); event.stopPropagation(); } } );
								this.getItemsOfMenu().on( {
									click: function() {
										var $this = $( this );
										if ( $this.is( '.active' ) ) { return; }
										jGallery.thumbnails.setActiveAlbum( jGallery.thumbnails.$albums.filter( '[data-jgallery-album-title="' + $this.attr( 'data-jgallery-album-title' ) + '"]' ) );
									}
								} );
								$html.on( 'click', function(){ self.menuHide(); } );
							},
							setTitle: function( strTitle ) { this.$title.html( strTitle ); },
							getTitle: function() { return this.$title.html(); },
							getListOfAlbums: function() { return this.getElement().find( '.menu' ); },
							getElement: function() { return this.$element; },
							getItemsOfMenu: function() { return this.getListOfAlbums().find( '.item' ); },
							appendToMenu: function( strHtml ) { this.getListOfAlbums().append( strHtml ); },
							menuToggle: function() { this.getElement().toggleClass( 'active' ); },
							menuHide: function() { this.getElement().removeClass( 'active' ); },
							clearMenu: function() { this.getListOfAlbums().html( '' ); },
							refreshMenuHeight: function() { this.getListOfAlbums().css( 'max-height', this.jGallery.zoom.$container.outerHeight() - 8 ); }
						};
						return IconChangeAlbum;
					} )();
					var Progress = ( function() {
						var Progress = function( $this, jGallery ) { this.jGallery = jGallery; this.$element = $this; };
						Progress.prototype = {
							clear: function() {
								this.$element.stop( false, true ).css( {width: 0} );
								return this;
							},
							start: function( intWidth, success ) {
								var interval = parseInt( this.jGallery.options.slideshowInterval ) * 1000;
								var $element = this.$element;
								$element.animate( { width: intWidth }, interval - interval * ( $element.width() / $element.parent().width() ), 'linear', success );
								return this;
							},
							pause: function() {
								this.$element.stop();
								return this;
							}
						};
						return Progress;
					} )();
					var Thumbnails = ( function( jLoader ) {
						var $ = jQuery;
						var $head = $( 'head' );
						var $window = $( window );
						$.fn.jLoader = jLoader;
						var Thumbnails = function( jGallery ) {
							this.$element = jGallery.$element.find( '.jgallery-thumbnails' );
							this.$a = this.getElement().find( 'a' );
							this.$img = this.getElement().find( 'img' );
							this.$container = this.getElement().find( '.jgallery-container' );
							this.$albums = this.getElement().find( '.album' ).length ? this.getElement().find( '.album' ) : this.getElement().find( '.jgallery-container-inner' ).addClass( 'active' );
							this.$btnNext = this.getElement().children( '.next' );
							this.$btnPrev = this.getElement().children( '.prev' );
							this.intJgalleryId = jGallery.$element.attr( 'data-jgallery-id' );
							this.isJgalleryInitialized = jGallery.$element.is( '[data-jgallery-id]' );
							this.zoom = jGallery.zoom;
							this.$iconToggleThumbsVisibility = this.zoom.$container.find( '.minimalize-thumbnails' );
							this.jGallery = jGallery;
							if ( this.jGallery.options.swipeEvents ) { this.initSwipeEvents(); }
						};
						Thumbnails.prototype = {
							getElement: function() { return this.$element; },
							init: function() {
								this.getElement().removeClass( 'square number images jgallery-thumbnails-left jgallery-thumbnails-right jgallery-thumbnails-top jgallery-thumbnails-bottom jgallery-thumbnails-horizontal jgallery-thumbnails-vertical' );
								this.getElement().addClass( 'jgallery-thumbnails-' + this.jGallery.options.thumbnailsPosition );
								if ( this.isVertical() ) { this.getElement().addClass( 'jgallery-thumbnails-vertical' ); }
								if ( this.isHorizontal() ) { this.getElement().addClass( 'jgallery-thumbnails-horizontal' ); }
								if ( this.jGallery.options.thumbType === 'image' ) { this._initImages(); }
								if ( this.jGallery.options.thumbType === 'square' ) { this._initSquare(); }
								if ( this.jGallery.options.thumbType === 'number' ) { this._initNumber(); }
							},
							initSwipeEvents: function() {
								if ( ! $.fn.swipe ) { return; }
								var $container = this.$container;
								var self = this;
								var canScrollToPrev;
								var canScrollToNext;
								var translate = function( distance ) {
									if ( self.isVertical() || self.isFullScreen() )
									{
										$container.css( { "-webkit-transform": 'translateY(' + distance + 'px)', "transform": 'translateY(' + distance + 'px)' } );
									}
									else
									{
										$container.css( { "-webkit-transform": 'translateX(' + distance + 'px)', "transform": 'translateX(' + distance + 'px)' } );
									}
								};
								$container.swipe( {
									swipeStatus: function ( event, phase, direction, distance ) {
										if ( phase === "start" ) { canScrollToPrev = self.canScrollToPrev(); canScrollToNext = self.canScrollToNext(); }
										else if ( phase === "move" ) 
										{
											if ( canScrollToNext && ( direction === "left" || direction === "down" ) ) { translate( - distance ); }
											else if ( canScrollToPrev ) { translate( distance ); }
										}
										else if ( phase === "end" )
										{
											if ( canScrollToNext && ( direction === "left" || direction === "down" ) ) { self._scrollToNext(); translate( 0 ); }
											else if ( canScrollToPrev ) { self._scrollToPrev(); translate( 0 ); }
										}
										else { translate( 0 ); }
									}
								} );
							},
							show: function() {
								var self = this;
								if ( ! this.getElement().is( '.hidden' ) ) { return; }
								if ( ! ( this.jGallery.isMobile() && this.jGallery.options.thumbnailsHideOnMobile ) ) { this.getElement().removeClass( 'hidden' ); }
								if ( ! this.getElement().is( '.loaded' ) )
								{
									this.getElement().jLoader( {
										start: function() {},
										success: function(){
											self._showNextThumb();
											self.$a.parent( '.album:not(.active)' ).children( '.hidden' ).removeClass( 'hidden' );
											self.getElement().addClass( 'loaded' );
										}
									} );
								}
								else
								{
									this._showNextThumb();
									this.$a.parent( '.album:not(.active)' ).children( '.hidden' ).removeClass( 'hidden' );
								}
								this.$iconToggleThumbsVisibility.removeClass( 'inactive' );
							},
							showThumbsForActiveAlbum: function() {
								this.$a.addClass( 'hidden' );
								this._showNextThumb();
							},
							hide: function( options ) {
								options = $.extend( { hideEachThumb: true }, options );
								this.getElement().addClass( 'hidden' );
								if ( options.hideEachThumb ) { this.$a.addClass( 'hidden' ); }
								this.$iconToggleThumbsVisibility.addClass( 'inactive' );
							},
							toggle: function() {
								this.getElement().is( '.hidden' ) ? this.show() : this.hide( { hideEachThumb: false } );
							},
							setActiveThumb: function( $a ) {
								var $img = $a.find( 'img' );
								var $album = this.$albums.filter( '.active' );
								var $a = $album.find( 'img[src="' + $img.attr( 'src' ) + '"]' ).parent( 'a' ).eq( 0 );
								this.getElement().find( 'a' ).removeClass( 'active' );
								$a.addClass( 'active' );
								if ( $album.find( 'a.active' ).length === 0 ) { $album.find( 'a:first-child' ).eq( 0 ).addClass( 'active' ); }
								this.center( $a );
							},
							isHorizontal: function() { return this.jGallery.options.thumbnailsPosition === 'top' || this.jGallery.options.thumbnailsPosition === 'bottom'; },
							isVertical: function() { return this.jGallery.options.thumbnailsPosition === 'left' || this.jGallery.options.thumbnailsPosition === 'right'; },
							isFullScreen: function() { return this.getElement().is( '.full-screen' ); },
							refreshNavigation: function() {
								this.canScrollToPrev() ? this.$btnPrev.addClass( 'visible' ) : this.$btnPrev.removeClass( 'visible' );
								this.canScrollToNext() ? this.$btnNext.addClass( 'visible' ) : this.$btnNext.removeClass( 'visible' );
							},
							center: function( $a ) {
								if ( this.isHorizontal() ) { this._horizontalCenter( $a ); }
								if ( this.isVertical() ) { this._verticalCenter( $a ); }
							},
							reload: function() {
								this.$a = this.getElement().find( 'a' );
								this.$img = this.getElement().find( 'img' );
								this.$albums = this.getElement().find( '.album' ).length ? this.getElement().find( '.album' ) : this.getElement().find( '.jgallery-container-inner' );
								this.zoom.showPhoto( this.$albums.find( 'a' ).eq( 0 ) );
							},
							bindEvents: function() {
								var self = this;
								this.$btnNext.on( 'click', function() { self._scrollToNext(); } );
								this.$btnPrev.on( 'click', function() { self._scrollToPrev(); } );
								this.zoom.$container.find( '.full-screen' ).on( { click: function() { self.zoom.slideshowPause(); self.changeViewToFullScreen(); } } );
								this.getElement().find( '.jgallery-close' ).on( { click: function() { self.changeViewToBar(); self.zoom.refreshSize(); } } );
							},
							changeViewToBar: function() {
								this.getElement().removeClass( 'full-screen' );
								if ( this.isHorizontal() ) { this.getElement().addClass( 'jgallery-thumbnails-horizontal' ).removeClass( 'jgallery-thumbnails-vertical' ); }
								this.refreshNavigation();
							},
							changeViewToFullScreen: function() {
								this.getElement().addClass( 'full-screen' );
								if ( this.isHorizontal() ) { this.getElement().addClass( 'jgallery-thumbnails-vertical' ).removeClass( 'jgallery-thumbnails-horizontal' ); }
								this.refreshNavigation();
							},
							setActiveAlbum: function( $album ) {
								if ( ! this.jGallery.booIsAlbums || $album.is( '.active' ) ) { return; }
								this.$albums.not( $album.get( 0 ) ).removeClass( 'active' );
								$album.addClass( 'active' );
								this.jGallery.iconChangeAlbum.getListOfAlbums().find( '.item' ).removeClass( 'active' ).filter( '[data-jgallery-album-title="' + $album.attr( 'data-jgallery-album-title' ) + '"]' ).addClass( 'active' );
								this.jGallery.iconChangeAlbum.setTitle( $album.attr( 'data-jgallery-album-title' ) );
								this.refreshNavigation();
								if ( ! this.getElement().is( '.full-screen' ) && this.jGallery.$element.is( ':visible' ) ) { this.zoom.showPhoto( $album.find( 'a' ).eq( 0 ) ); }
								this.showThumbsForActiveAlbum();
							},
							_initSquare: function() { this.getElement().addClass( 'square' ); },
							_initNumber: function() { this.getElement().addClass( 'number' ); this._initSquare(); },
							_initImages: function() {
								var $css = $head.find( 'style.jgallery-thumbnails[data-jgallery-id="' + this.intJgalleryId + '"]' );
								var strCss = '\
									.jgallery[data-jgallery-id="' + this.intJgalleryId + '"] .jgallery-thumbnails a {\n\
										width: ' + this.jGallery.options.thumbWidth + 'px;\n\
										height: ' + this.jGallery.options.thumbHeight + 'px;\n\
										font-size: ' + this.jGallery.options.thumbHeight + 'px;\n\
									}\n\
									.jgallery[data-jgallery-id="' + this.intJgalleryId + '"] .jgallery-thumbnails.full-screen a {\n\
										width: ' + this.jGallery.options.thumbWidthOnFullScreen + 'px;\n\
										height: ' + this.jGallery.options.thumbHeightOnFullScreen + 'px;\n\
										font-size: ' + this.jGallery.options.thumbHeightOnFullScreen + 'px;\n\
									}\n\
									.jgallery[data-jgallery-id="' + this.intJgalleryId + '"] .jgallery-thumbnails-horizontal {\n\
										height: ' + parseInt( this.jGallery.options.thumbHeight + 2 ) + 'px;\n\
									}\n\
									.jgallery[data-jgallery-id="' + this.intJgalleryId + '"] .jgallery-thumbnails-vertical {\n\
										width: ' + parseInt( this.jGallery.options.thumbWidth + 2 ) + 'px;\n\
									}\n\
								';
								this.getElement().addClass( 'images' );
								$css.length ? $css.html( strCss ) : $head.append( '\
									<style type="text/css" class="jgallery-thumbnails" data-jgallery-id="' + this.intJgalleryId + '">\
										' + strCss + '\
									</style>\
								');
								if ( this.isHorizontal() )
								{
									this.jGallery.zoom.$container.find( '.minimalize-thumbnails' ).addClass( 'totalsoft-ellipsis-h' ).removeClass( 'totalsoft-ellipsis-v' );
								}
								else
								{
									this.jGallery.zoom.$container.find( '.minimalize-thumbnails' ).addClass( 'totalsoft-ellipsis-v' ).removeClass( 'totalsoft-ellipsis-h' );
								}
								if ( this.isJgalleryInitialized ) { return; }
								this.hide();
							},
							_showNextThumb: function() {
								var self = this;
								var $nextThumb = this.$a.parent( '.active' ).children( '.hidden' ).eq( 0 );
								setTimeout( function() { $nextThumb.removeClass( 'hidden' ); if ( $nextThumb.length ) { self._showNextThumb(); } }, 70 );
							},
							_horizontalCenter: function( $a ) {
								var self = this;
								if ( $a.length !== 1 ) { return; }
								this.$container.stop( false, true ).animate( {
									'scrollLeft': $a.position().left - this.$container.scrollLeft() * -1 - $a.outerWidth() / -2 - this.$container.outerWidth() / 2
								}, function() { self.refreshNavigation(); } );
							},
							_verticalCenter: function( $a ) {
								var self = this;
								if ( $a.length !== 1 ) { return; }
								this.$container.stop( false, true ).animate( {
									'scrollTop': $a.position().top - this.$container.scrollTop() * -1 - $a.outerHeight() / -2 - this.$container.outerHeight() / 2
								}, function() { self.refreshNavigation(); } );
							},
							canScrollToPrev: function() {
								if ( this.isVertical() || this.isFullScreen() ) { return this.$container.scrollTop() > 0; } else { return this.$container.scrollLeft() > 0; }
							},
							canScrollToNext: function() {
								if ( this.isVertical() || this.isFullScreen() )
								{
									return this.$container.find( '.jgallery-container-inner' ).height() > this.$container.height() + this.$container.scrollTop();
								}
								else
								{
									var $album = this.getElement().find( 'div.active' );
									var intThumbsWidth = this.jGallery.options.thumbType === 'image' ? this.$a.outerWidth( true ) * $album.find( 'img' ).length : this.$a.outerWidth( true ) * $album.find( 'a' ).length;
									return intThumbsWidth > this.$container.width() + this.$container.scrollLeft();
								}
							},
							_scrollToPrev: function() {
								var self = this;
								if ( this.isVertical() || this.isFullScreen() )
								{
									this.$container.stop( false, true ).animate( { 'scrollTop': "-=" + $window.height() * 0.7 }, function() { self.refreshNavigation(); } );
								} 
								else if ( this.isHorizontal() ) 
								{
									this.$container.stop( false, true ).animate( { 'scrollLeft': "-=" + $window.width() * 0.7 }, function() { self.refreshNavigation(); } );
								}
							},
							_scrollToNext: function() {
								var self = this;
								if ( this.isVertical() || this.isFullScreen() )
								{
									this.$container.stop( false, true ).animate( { 'scrollTop': "+=" + $window.height() * 0.7 }, function() { self.refreshNavigation(); } );
								}
								else if ( this.isHorizontal() )
								{
									this.$container.stop( false, true ).animate( { 'scrollLeft': "+=" + $window.width() * 0.7 }, function() { self.refreshNavigation(); } );
								}
							}
						};
						return Thumbnails;
					} )( jLoader );
					var ThumbnailsGenerator = ( function( outerHtml, jLoader ) {
						var $ = jQuery;
						$.fn.outerHtml = outerHtml;
						$.fn.jLoader = jLoader;
						var ThumbnailsGenerator = function( jGallery, options ) {
							this.options = $.extend( {}, { thumbsHidden: true }, options );
							this.jGallery = jGallery;
							this.isSlider = jGallery.isSlider();
							this.$element = jGallery.$this;
							this.booIsAlbums = jGallery.booIsAlbums;
							this.$tmp;
							this.intI = 1;
							this.intJ = 1;
							this.intNo;
							this.$thumbnailsContainerInner = this.jGallery.$jgallery.find( '.jgallery-thumbnails .jgallery-container-inner' );
							this.start();
						};
						ThumbnailsGenerator.prototype = {
							start: function() {
								var self = this;
								var selector = this.jGallery.isSlider() ? '.album:has(img)' : '.album:has(a:has(img))';
								$( 'body' ).append( '<div id="jGalleryTmp" style="position: absolute; top: 0; left: 0; width: 0; height: 0; z-index: -1; overflow: hidden;">' + this.$element.html() + '</div>' );
								this.$tmp = $( '#jGalleryTmp' );
								this.$thumbnailsContainerInner.html( '' );
								if ( this.booIsAlbums ) { this.$tmp.find( selector ).each( function() { self.insertAlbum( $( this ) ); } ); }
								else { this.insertImages( this.$tmp, this.$thumbnailsContainerInner ); }
								this.$tmp.remove();
								this.refreshThumbsSize();
							},
							insertAlbum: function( $this ) {
								var strTitle = $this.is( '[data-jgallery-album-title]' ) ? $this.attr( 'data-jgallery-album-title' ) : 'Album ' + this.intJ;
								var $album = this.$thumbnailsContainerInner.append( '<div class="album" data-jgallery-album-title="' + strTitle + '"></div>' ).children( ':last-child' );
								if ( this.intJ === 1 ) { $album.addClass( 'active' ); }
								this.insertImages( $this, $album );
								this.intJ++;
							},
							insertImages: function( $images, $container ) {
								var self = this;
								var selector = this.jGallery.isSlider() ? 'img' : 'a:has(img)';
								this.intNo = 1;
								$images.find( selector ).each( function() { self.insertImage( $( this ), $container ); } );
							},
							insertImage: function( $this, $container ) {
								var $a = $();
								var $parent;
								if ( $this.is( 'a' ) )
								{
									$a = $container.append( '<a href="' + $this.attr( 'href' ) + '">' + this.generateImgTag( $this.find( 'img' ).eq( 0 ) ).outerHtml() + '</a>' ).children( ':last-child' );
								}
								else if ( $this.is( 'img' ) )
								{
									$a = $container.append( $( '<a href="' + $this.attr( 'src' ) + '">' + this.generateImgTag( $this ).outerHtml() + '</a>' ) ).children( ':last-child' );
									$parent = $this.parent();
									if ( this.isSlider && $parent.is( 'a' ) )
									{
										$a.attr( 'link', $parent.attr( 'href' ) );
										if ( $parent.is( '[target]' ) ) { $a.attr( 'target', $parent.attr( 'target' ) ); }
									}
								}
								$a.jLoader( {
									start: function() { $a.overlay( { fadeIn: false, fadeOut: false, show: true, showLoader: true } ); },
									success: function() { $a.overlay( { hide: true } ); }
								} );
								$container.children( ':last-child' ).attr( 'data-jgallery-photo-id', this.intI++ ).attr( 'data-jgallery-number', this.intNo++ );
							},
							generateImgTag: function( $img ) {
								var $newImg = $( '<img src="' + $img.attr( 'src' ) + '" />' );
								if ( $img.is( '[alt]' ) ) { $newImg.attr( 'alt', $img.attr( 'alt' ) ); }
								if ( $img.is( '[data-jgallery-bg-color]' ) ) { $newImg.attr( 'data-jgallery-bg-color', $img.attr( 'data-jgallery-bg-color' ) ); }
								if ( $img.is( '[data-jgallery-text-color]' ) ) { $newImg.attr( 'data-jgallery-text-color', $img.attr( 'data-jgallery-text-color' ) ); }
								return $newImg;
							},
							refreshThumbsSize: function() {
								var options = this.jGallery.options;
								this.$thumbnailsContainerInner.find( 'img' ).each( function() {
									var $image = $( this );
									var image = new Image();
									image.src = $image.attr( 'src' );
									if ( ( image.width / image.height ) < ( options.thumbWidth / options.thumbHeight ) ) { $image.addClass( 'thumb-vertical' ).removeClass( 'thumb-horizontal' ); }
									else { $image.addClass( 'thumb-horizontal' ).removeClass( 'thumb-vertical' ); }
									if ( ( image.width / image.height ) < ( options.thumbWidthOnFullScreen / options.thumbHeightOnFullScreen ) )
									{
										$image.addClass( 'thumb-on-full-screen-vertical' ).removeClass( 'thumb-on-full-screen-horizontal' );
									}
									else { $image.addClass( 'thumb-on-full-screen-horizontal' ).removeClass( 'thumb-on-full-screen-vertical' ); }
								} );
							}
						};
						return ThumbnailsGenerator;
					} )( outerHtml, jLoader );
					var Zoom = ( function( jLoader, overlay, historyPushState, jGalleryTransitions, jGalleryArrayTransitions, jGalleryBackwardTransitions, AdvancedAnimation, IconChangeAlbum ) {
						var $ = jQuery;
						var $body = $( 'body' );
						$.fn.jLoader = jLoader;
						$.fn.overlay = overlay;
						var Zoom = function( jGallery ) {
							this.$container = jGallery.$element.children( '.zoom-container' );
							this.$element = this.$container.children( '.zoom' );
							this.$title = this.$container.find( '.nav-bottom > .title' );
							this.$btnPrev = this.$container.children( '.prev' );
							this.$btnNext = this.$container.children( '.next' );
							this.thumbnails = jGallery.thumbnails;
							this.$jGallery = jGallery.$element;
							this.jGallery = jGallery;
							this.$resize = this.$container.find( '.resize' );
							this.$dragNav = this.$container.find( '.drag-nav' );
							this.$dragNavCrop = $();
							this.$dragNavCropImg = $();
							this.$changeMode = this.$container.find( '.totalsoft.change-mode' );
							this.$random = this.$container.find( '.random' );
							this.$slideshow = this.$container.find( '.slideshow' );
							this.intJGalleryId = this.$jGallery.attr( 'data-jgallery-id' );
							this.booSlideshowPlayed = false;
							this.booLoadingInProgress = false;
							this.booLoadedAll = false;
							this.$title.on( 'click', function() { $( this ).toggleClass( 'expanded' ); } );
							this.update();
							this.enableDrag();
						};
						Zoom.prototype = {
							update: function() {
								var transition = jGalleryTransitions[ this.jGallery.options.transition ];
								this.$container.attr( 'data-size', this.jGallery.options.zoomSize );
								this.$element.find( '.pt-page' )
									.removeClass( this.jGallery.options.hideEffect )
									.removeClass( this.jGallery.options.showEffect );
								if ( typeof transition !== 'undefined' )
								{
									this.jGallery.options.hideEffect = transition[ 0 ];
									this.jGallery.options.showEffect = transition[ 1 ];
								}
								this.initAdvancedAnimation();
							},
							initAdvancedAnimation: function() {
								if ( typeof this.advancedAnimation === 'undefined' ) { this.advancedAnimation = new AdvancedAnimation( this.$element ); }
								this.advancedAnimation.setAnimationProperties( {
									duration: this.jGallery.options.transitionDuration,
									transitionTimingFunction: this.jGallery.options.transitionTimingFunction
								} );
								this.advancedAnimation.setDirection( this.jGallery.options.transitionWaveDirection );
								this.advancedAnimation.setQuantityParts( this.jGallery.options.transitionCols, this.jGallery.options.transitionRows );
								this.advancedAnimation.setHideEffect( this.jGallery.options.hideEffect );
								this.advancedAnimation.setShowEffect( this.jGallery.options.showEffect );
							},
							setThumbnails: function( thumbnails ) { this.thumbnails = thumbnails; },
							showDragNav: function() { this.$dragNav.removeClass( 'hide' ).addClass( 'show' ); },
							hideDragNav: function() { this.$dragNav.removeClass( 'show' ).addClass( 'hide' ); },
							refreshDragNavVisibility: function() {
								var $img = this.$element.find( 'img.active' );
								if ( $img.width() <= this.$element.outerWidth() || $img.height() <= this.$element.outerHeight() ) { this.hideDragNav(); } else { this.showDragNav(); }
							},
							enableDrag: function() {
								var self = this;
								var startMarginLeft;
								var startMarginTop;
								var startX;
								var startY;
								var point;
								var $img;
								var calcDraggedX = function() { return parseInt( startMarginLeft ) - parseInt( $img.css( 'margin-left' ) ); };
								var startDrag = function( event ) {
									startX = event.pageX;
									startY = event.pageY;
									point = event;
									$img = self.$element.find( 'img.active' );
									startMarginLeft = $img.css( 'margin-left' );
									startMarginTop = $img.css( 'margin-top' );
									self.$element.on( {
										mousemove: move,
										touchmove: move,
										mouseleave: stopDrag,
										touchend: stopDrag
									} );
									if ( self.jGallery.options.zoomSize === 'fill' ) { self.$dragNav.removeClass( 'hide' ).addClass( 'show' ); }
									drag( 0, 0 );
								};
								var stopDrag = function() {
									var draggedX = calcDraggedX();
									var moveX = startX - point.pageX;
									self.$element.off( 'mousemove touchmove mouseleave touchend' );
									if ( self.jGallery.options.zoomSize === 'fill' ) { self.$dragNav.removeClass( 'show' ).addClass( 'hide' ); }
									if ( self.jGallery.options.swipeEvents && draggedX === 0 ) { if ( moveX > 0 ) { self.showNextPhoto(); } else if ( moveX < 0 ) { self.showPrevPhoto(); } }
								};
								var move = function( event ) {
									point = event.type === 'touchmove' ? event.originalEvent.touches[0] : event;
									var distance = { x: point.pageX - startX, y: point.pageY - startY };
									var dragged = {};
									if ( self.jGallery.options.draggableZoom ) { dragged = drag( distance.x, distance.y ); }
									if ( (Math.abs(distance.y) > Math.abs(distance.x)) && dragged.y ) { event.preventDefault(); }
									else if ( (Math.abs(distance.x) >= Math.abs(distance.y)) && dragged.x ) { event.preventDefault(); }
								};
								var drag = function( x, y ) {
									var marginLeft = parseFloat( parseFloat( startMarginLeft ) + x );
									var marginTop = parseFloat( parseFloat( startMarginTop ) + y );
									var $img = self.$element.find( 'img.active' );
									var $first = $img.eq( 0 );
									var firstPosition = $first.position();
									var firstPositionLeft = firstPosition.left;
									var firstPositionTop = firstPosition.top;
									var $last = $img.eq( -1 );
									var lastPosition = $last.position();
									var $lastParent = $last.parent();
									var $dragNavCrop = self.$dragNavCrop;
									var dragNavCropPosition = $dragNavCrop.position();
									var canDrag = {
										x: firstPositionLeft + marginLeft < 0 && lastPosition.left + $last.width() + marginLeft > $lastParent.outerWidth(),
										y: firstPositionTop + marginTop < 0 && lastPosition.top + $last.height() + marginTop > $lastParent.outerHeight()
									};
									if ( canDrag.x )
									{
										$img.css( { 'margin-left': marginLeft } );
										$dragNavCrop.css( { left: - ( firstPositionLeft + marginLeft ) / $img.width() * 100 + '%' } );
									}
									if ( canDrag.y )
									{
										$img.css( { 'margin-top': marginTop } );
										$dragNavCrop.css( { top: - ( firstPositionTop + marginTop ) / $img.height() * 100 + '%' } );
									}
									if ( dragNavCropPosition )
									{
										self.$dragNavCropImg.css( { 'margin-left': - dragNavCropPosition.left, 'margin-top': - dragNavCropPosition.top } );
									}
									return canDrag;
								};
								this.refreshDragNavCropSize();
								this.$element.css( 'cursor', 'move' ).on( {
									mousedown: function( event ) { startDrag( event ); self.slideshowPause(); },
									touchstart: function( event ) { startDrag( event.originalEvent.touches[0] ); self.slideshowPause(); },
									mouseup: function() { stopDrag(); },
									touchend: function() { stopDrag(); }
								} );
							},
							refreshContainerSize: function () {
								var intNavBottomHeight = this.jGallery.isSlider() ? 0 : this.$container.find( '.nav-bottom' ).outerHeight();
								var isThumbnailsVisible = ! this.jGallery.isSlider() && ! this.thumbnails.getElement().is( '.hidden' );
								var strThumbnailsPosition = isThumbnailsVisible ? this.jGallery.options.thumbnailsPosition : '';
								this.$container.css( {
									'width': isThumbnailsVisible && this.thumbnails.isVertical() ? this.$jGallery.width() - this.thumbnails.getElement().outerWidth( true ) : 'auto',
									'height': isThumbnailsVisible && this.thumbnails.isHorizontal() ? this.$jGallery.height() - this.thumbnails.getElement().outerHeight( true ) - intNavBottomHeight : this.$jGallery.height() - intNavBottomHeight,
									'margin-top': strThumbnailsPosition === 'top' ? this.thumbnails.getElement().outerHeight( true ) : 0,
									'margin-left': strThumbnailsPosition === 'left' ? this.thumbnails.getElement().outerWidth( true ) : 0,
									'margin-right': strThumbnailsPosition === 'right' ? this.thumbnails.getElement().outerWidth( true ) : 0
								} );
								if ( this.jGallery.options.draggableZoom ) { this.refreshDragNavCropSize(); }
							},
							refreshSize: function() {
								if ( this.thumbnails.isFullScreen() ) { return; }
								this.refreshContainerSize();
								if ( this.jGallery.options.zoomSize === 'original' ) { this.original(); }
								else if ( this.jGallery.options.zoomSize === 'fill' ) { this.fill(); }
								else { this.fit(); }
								if ( this.jGallery.options.draggableZoom ) { this.refreshDragNavCropSize(); this.refreshDragNavVisibility(); }
								this.$element.addClass( 'visible' );
							},
							refreshDragNavCropSize: function() {
								var $img = this.$element.find( 'img.active' );
								var cropPositionLeft;
								var cropPositionTop;
								this.$dragNavCrop.css( { width: this.$element.width() / $img.width() * 100 + '%', height: this.$element.height() / $img.height() * 100 + '%' } );
								if ( $img.attr( 'data-width' ) < this.$container.outerWidth() ) { cropPositionLeft = 0; }
								else { cropPositionLeft = ( this.$dragNav.width() - this.$dragNavCrop.width() ) / 2; }
								if ( $img.attr( 'data-height' ) < this.$container.outerHeight() ) { cropPositionTop = 0; }
								else { cropPositionTop = ( this.$dragNav.height() - this.$dragNavCrop.height() ) / 2; }
								this.$dragNavCrop.css( { left: cropPositionLeft, top: cropPositionTop } );
								if ( this.$dragNavCropImg.length ) { this.$dragNavCropImg.css( { 'margin-left': - cropPositionLeft, 'margin-top': - cropPositionTop } ); }
							},
							changeSize: function() {
								if ( this.jGallery.options.zoomSize === 'fit' ) { this.jGallery.options.zoomSize = 'fill'; }
								else if ( this.jGallery.options.zoomSize === 'fill' ) 
								{
									var $img = this.$element.find( 'img.active' ).eq( 0 );
									if ( this.$element.outerWidth().toString() === $img.attr( 'data-width' ) ) { this.jGallery.options.zoomSize = 'fit'; }
									else { this.jGallery.options.zoomSize = 'original'; }
								}
								else if ( this.jGallery.options.zoomSize === 'original' ) { this.jGallery.options.zoomSize = 'fit'; }
								this.refreshSize();
								this.$container.attr( 'data-size', this.jGallery.options.zoomSize );
							},
							original: function() {
								var $img = this.$element.find( 'img.active' );
								this.advancedAnimation.setPositionParts();
								this.setImgSizeForOriginal( $img );
								this.setImgSizeForOriginal( this.$element.find( '.pt-page.init img' ) );
								if ( $img.attr( 'data-width' ) <= this.$element.outerWidth() && $img.attr( 'data-height' ) <= this.$element.outerHeight() )
								{
									this.$resize.addClass( 'totalsoft-search-plus' ).removeClass( 'totalsoft-search-minus' );
								}
								else { this.$resize.addClass( 'totalsoft-search-minus' ).removeClass( 'totalsoft-search-plus' ); }
							},
							fit: function() {
								var $img = this.$element.find( 'img.active' ).add( this.$element.find( '.pt-page.init img' ) );
								this.advancedAnimation.setPositionParts();
								this.setImgSizeForFit( $img.filter( '.active' ) );
								this.setImgSizeForFit( $img.filter( ':not( .active )' ) );
								this.$resize.addClass( 'totalsoft-search-plus' ).removeClass( 'totalsoft-search-minus' );
							},
							fill: function() {
								var $img = this.$element.find( 'img.active' );
								this.setImgSizeForFill( $img );
								this.setImgSizeForFill( this.$element.find( '.pt-page.init img' ) );
								this.advancedAnimation.setPositionParts();
								if ( $img.attr( 'data-width' ) > $img.width() && $img.attr( 'data-height' ) > $img.height() )
								{
									this.$resize.addClass( 'totalsoft-search-plus' ).removeClass( 'totalsoft-search-minus' );
								}
								else { this.$resize.addClass( 'totalsoft-search-minus' ).removeClass( 'totalsoft-search-plus' ); }
							},
							setImgSizeForOriginal: function( $img ) {
								$img.css( { 'width': $img.attr( 'data-width' ), 'height': $img.attr( 'data-height' ), 'min-width': 0, 'min-height': 0,'max-width': 'none', 'max-height': 'none'} );
								$img.css( { 'margin-top': - $img.height() / 2, 'margin-left': - $img.width() / 2 } );
							},
							setImgSizeForFit: function( $img ) {
								var intNavBottomHeight = this.jGallery.isSlider() ? 0 : this.$container.find( '.nav-bottom' ).outerHeight();
								var isThumbnailsVisible = ! this.jGallery.isSlider() && ! this.thumbnails.getElement().is( '.hidden' );
								$img.css( {
									'width': 'auto',
									'height': 'auto',
									'min-width': 0,
									'min-height': 0,
									'max-width': isThumbnailsVisible && this.thumbnails.isVertical() ? this.$jGallery.width() - this.thumbnails.getElement().outerWidth( true ) : this.$jGallery.width(),
									'max-height': isThumbnailsVisible && this.thumbnails.isHorizontal() ? this.$jGallery.height() - this.thumbnails.getElement().outerHeight( true ) - intNavBottomHeight : this.$jGallery.height() - intNavBottomHeight
								} );
								if ( $img.width() / $img.height() / this.jGallery.getCanvasRatioWidthToHeight() < 1 )
								{
									$img.css( {
										'width': 'auto',
										'height': <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>*jQuery('.jgallery').width()/(jQuery('.jgallery').width()+350)-80
									} );
								}
								else
								{
									$img.css( {
										'width': isThumbnailsVisible && this.thumbnails.isVertical() ? this.$jGallery.width() - this.thumbnails.getElement().outerWidth( true ) : this.$jGallery.width(),
										'height': 'auto'
									} );
								}
								$img.css( { 'margin-top': - $img.height() / 2, 'margin-left': - $img.width() / 2 } );
							},
							setImgSizeForFill: function( $img ) {
								var intNavBottomHeight = this.jGallery.isSlider() ? 0 : this.$container.find( '.nav-bottom' ).outerHeight();
								var isThumbnailsVisible = ! this.jGallery.isSlider() && ! this.thumbnails.getElement().is( '.hidden' );
								$img.css( { 'width': 'auto', 'height': 'auto', 'max-width': 'none', 'max-height': 'none', 'min-width': 0, 'min-height': 0 } );
								if ( $img.width() / $img.height() / this.jGallery.getCanvasRatioWidthToHeight() > 1 )
								{
									$img.css( {
										'width': 'auto',
										'height': <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>*jQuery('.jgallery-standard').width()/(jQuery('.jgallery-standard').width()+350)
									} );
								}
								else
								{
									$img.css( {
										'width': isThumbnailsVisible && this.thumbnails.isVertical() ? this.$jGallery.width() - this.thumbnails.getElement().outerWidth( true ) : this.$jGallery.width(),
										'height': 'auto'
									} );
								}
								$img.css( {
									'min-width': isThumbnailsVisible && this.thumbnails.isVertical() ? this.$jGallery.width() - this.thumbnails.getElement().outerWidth( true ) : this.$jGallery.width(),
									'min-height': isThumbnailsVisible && this.thumbnails.isHorizontal() ? this.$jGallery.height() - this.thumbnails.getElement().outerHeight( true ) - intNavBottomHeight : this.$jGallery.height() - intNavBottomHeight
								} );
								$img.css( { 'margin-top': - $img.height() / 2, 'margin-left': - $img.width() / 2 } );
							},
							isAddedToLoad: function( $a ) { return this.$element.find( 'img' ).filter( '[src="' + $a.attr( 'href' ) + '"]' ).length > 0; },
							isLoaded: function( $a ) {
								var img = this.$element.find( 'img' ).filter( '[src="' + $a.attr( 'href' ) + '"]' ).get( 0 );
								if ( img ) { return this.imgIsLoaded( img ); }
							},
							imgIsLoaded: function( img ) { return img.complete && img.naturalWidth > 0; },
							refreshNav: function() {
								var $thumbActive = this.thumbnails.getElement().find( 'div.active a.active' );
								$thumbActive.prev( 'a' ).length === 1 ? this.$btnPrev.removeClass( 'hidden' ) : this.$btnPrev.addClass( 'hidden' );
								$thumbActive.next( 'a' ).length === 1 ? this.$btnNext.removeClass( 'hidden' ) : this.$btnNext.addClass( 'hidden' );
							},
							slideshowStop: function () {
								this.slideshowPause();
								this.jGallery.progress.clear();
							},
							slideshowPause: function () {
								this.jGallery.progress.pause();
								this.$slideshow.removeClass( 'totalsoft-pause' ).addClass( 'totalsoft-play' );
								this.booSlideshowPlayed = false;
								if ( this.jGallery.options.slideshowCanRandom ) { this.$random.hide(); }
							},
							slideshowPlay: function() {
								if ( this.booLoadingInProgress || this.booSlideshowPlayed ) { return; }
								this.booSlideshowPlayed = true;
								this.$slideshow.removeClass( 'totalsoft-play' ).addClass( 'totalsoft-pause' );
								this.slideshowSetTimeout();
								if ( this.jGallery.options.slideshowCanRandom ) { this.$random.show(); }
							},
							slideshowPlayPause: function() {
								this.$slideshow.is( '.totalsoft-play' ) ? this.slideshowPlay() : this.slideshowPause();
							},
							slideshowSetTimeout: function() {
								var self = this;
								this.jGallery.progress.start( this.$container.width(), function() {
									self.jGallery.progress.clear();
									self.jGallery.options.slideshowRandom ? self.showRandomPhoto() : self.showNextPhotoLoop();
								} );
							},
							slideshowRandomToggle: function() {
								if ( this.jGallery.options.slideshowRandom ) { this.$random.removeClass( 'active' ); this.jGallery.options.slideshowRandom = false; }
								else { this.$random.addClass( 'active' ); this.jGallery.options.slideshowRandom = true; }
							},
							showNextPhotoLoop: function() {
								var $next = this.thumbnails.$a.filter( '.active' ).next( 'a' );
								if ( $next.length === 0 ) { $next = this.thumbnails.$albums.filter( '.active' ).find( 'a' ).eq( 0 ); }
								this.showPhoto( $next );
							},
							showRandomPhoto: function() {
								var $thumbnailsANotActive = this.thumbnails.$albums.filter( '.active' ).find( 'a:not(.active)' );
								this.showPhoto( $thumbnailsANotActive.eq( Math.floor( Math.random() * $thumbnailsANotActive.length ) ) );
							},
							showPrevPhoto: function() {
								var $prev = this.thumbnails.$a.filter( '.active' ).prev( 'a' );
								if ( $prev.length === 1 ) { this.showPhoto( $prev ); } 
							},
							showNextPhoto: function() {
								var $next = this.thumbnails.$a.filter( '.active' ).next( 'a' );
								if ( $next.length === 1 ) { this.showPhoto( $next ); }
							},
							showPhotoInit: function() { this.jGallery.init(); },
							showPhoto: function( $a, options ) {
								var self = this;
								var $imgThumb = $a.children( 'img' );
								var booIsLoaded;
								var albumTitle;
								var transition;
								var transitionName;
								//preload images next prev
								var $nexta=$a.next();
								if ($nexta.length>0) { if ( ! self.isAddedToLoad( $nexta ) ) { this.appendPhoto( $nexta ); } }
								var $preva=$a.prev();
								if ($preva.length>0){ if ( ! self.isAddedToLoad( $preva ) ) { this.appendPhoto( $preva ); } }
								//preload images next prev
								if ( ! this.jGallery.initialized() ) { this.showPhotoInit(); }
								if ( this.booLoadingInProgress ) { return; }
								this.booLoadingInProgress = true;
								transitionName = this.jGallery.options[ $a.nextAll( '.active' ).length > 0 ? 'transitionBackward' : 'transition' ];
								if ( transitionName === 'random' ) { this.setRandomTransition(); }
								else if ( transitionName === 'auto' )
								{
									transition = jGalleryTransitions[ jGalleryBackwardTransitions[ this.jGallery.options[ 'transition' ] ] ];
									this.advancedAnimation.setHideEffect( transition[0] );
									this.advancedAnimation.setShowEffect( transition[1] );
								}
								else
								{
									transition = jGalleryTransitions[ transitionName ];
									this.advancedAnimation.setHideEffect( transition[0] );
									this.advancedAnimation.setShowEffect( transition[1] );
								}
								this.$element.find( '.pt-page.init' ).remove();
								this.jGallery.options.showPhoto( $a, $imgThumb );
								if ( this.jGallery.$element.is( ':not(:visible)' ) ) { this.jGallery.show(); }
								this.thumbnails.changeViewToBar();
								if ( this.jGallery.booIsAlbums )
								{
									if ( this.jGallery.iconChangeAlbum.getTitle() === '' )
									{
										albumTitle = $a.parents( '.album' ).eq( 0 ).attr( 'data-jgallery-album-title' );
										this.jGallery.iconChangeAlbum.setTitle( albumTitle );
										this.jGallery.iconChangeAlbum.$element.find( '[data-jgallery-album-title="' + albumTitle + '"]' ).addClass( 'active' );
										$a.parents( '.album' ).addClass( 'active' ).siblings( '.album' ).removeClass( 'active' );
									}
								}
								this.thumbnails.setActiveAlbum( this.thumbnails.$albums.filter( '[data-jgallery-album-title="' + $a.parents( '[data-jgallery-album-title]' ).attr( 'data-jgallery-album-title' ) + '"]' ) );
								this.thumbnails.setActiveThumb( $a );
								if ( this.$element.find( 'img.active' ).attr( 'src' ) === $a.attr( 'href' ) )
								{
									this.booLoadingInProgress = false;
									this.setJGalleryColoursForActiveThumb();
									return;
								}
								if ( $a.is( '[link]' ) )
								{
									this.$element.addClass( 'is-link' );
									if ( $a.is( '[target="_blank"]') ) { this.$element.attr( 'onclick', 'window.open("' + $a.attr( 'link' ) + '")' ); }
									else { this.$element.attr( 'onclick', 'window.location="' + $a.attr( 'link' ) + '"' ); }
								}
								else { this.$element.removeClass( 'is-link' ); this.$element.removeAttr( 'onclick' ); }
								this.refreshNav();
								if ( this.jGallery.options.title ) { this.$title.addClass( 'after fade' ); }
								booIsLoaded = self.isLoaded( $a );
								if ( ! booIsLoaded )
								{
									if ( self.jGallery.options.preloadAll && ! self.booLoadedAll ) { this.appendAllPhotos(); }
									else if ( ! this.isAddedToLoad( $a ) ) { this.appendPhoto( $a ); }
								}
								this.$element.find( 'img.active' ).addClass( 'prev-img' );
								self.$container.find( 'img.active' ).removeClass( 'active' );
								self.$container.find( '[src="' + $a.attr( 'href' ) + '"]' ).addClass( 'active' );
								if ( self.jGallery.options.title && $imgThumb.is( '[alt]' ) ) { self.$title.removeClass( 'after' ).addClass( 'before' ); }
								if ( ! booIsLoaded || ( self.jGallery.options.preloadAll && ! self.booLoadedAll ) )
								{
									self.booLoadedAll = true;
									self.$container.overlay( {'show': true, 'showLoader': true, 'showProgress': self.jGallery.options.preloadAll, 'resetProgress': self.jGallery.options.preloadAll } );
									self.jGallery.options.beforeLoadPhoto( $a, $imgThumb );
									self.loadPhoto( self.$element, $a, options );
								}
								else { self.showPhotoSuccess( $a, $imgThumb, options ); }
							},
							appendPhoto: function ( $a ) {
								this.$element.find( '.pt-part' ).append( '\
									<div class="jgallery-container pt-page">\
										<div class="pt-item"><img src="' + $a.attr( 'href' ) + '" /></div>\
									</div>' );
							},
							appendAllPhotos: function() {
								var self = this;
								if ( ! this.jGallery.options.preloadAll ) { return; }
								this.thumbnails.$a.each( function() {
									var $a = $( this );
									if ( ! self.isAddedToLoad( $a ) )
									{
										self.$element.find( '.pt-part' ).append( '<div class="jgallery-container pt-page"><div class="pt-item"><img src="' + $a.attr( 'href' ) + '" /></div></div>' );
									}
								} );
								this.appendInitPhoto( this.thumbnails.$a.eq( -1 ) );
							},
							appendInitPhoto: function( $a ) {
								if ( $a.length !== 1 ) { return; }
								this.$element.find( '.pt-part' ).append( '\
									<div class="jgallery-container pt-page pt-page-current pt-page-ontop init" style="visibility: hidden;">\
										<div class="pt-item"><img src="' + $a.attr( 'href' ) + '" class="active loaded" /></div>\
									</div>' );
							},
							loadPhoto: function( $zoom, $a, options ) {
								var self = this;
								var $imgThumb = $a.children( 'img' );
								var intPercent = 0;
								var $ptPart = $zoom.find( '.pt-part' ).eq( 0 );
								var $toLoading = this.jGallery.options.preloadAll ? $ptPart : $ptPart.find( 'img.active' );
								$toLoading.jLoader( {
									interval: 500,
									skip: '.loaded',
									start: function() { },
									success: function() {
										$zoom.find( 'img' ).each( function() { var $this = $( this ); if ( self.imgIsLoaded( $this.get( 0 ) ) ) { $this.addClass( 'loaded' ); } } );
										self.$container.overlay( {'hide': true, 'hideLoader': true} );
										self.showPhotoSuccess( $a, $imgThumb, options );
									},
									progress: function( data ) {
										if ( ! self.jGallery.options.preloadAll ) { return; }
										intPercent = data.percent;
										self.$container.find( '.overlay .imageLoaderPositionAbsolute' ).find( '.progress-value' ).html( intPercent );
									}
								} );
							},
							showPhotoSuccess: function( $a, $imgThumb, options ) {
								var image;
								var $active = this.$element.find( 'img.active' );
								options = $.extend( {}, { historyPushState: true }, options );
								if ( $active.is( ':not([data-width])' ) )
								{
									image = new Image();
									image.src = $active.attr( 'src' );
									$active.attr( 'data-width', image.width );
									$active.attr( 'data-height', image.height );
								}
								if ( this.jGallery.options.title && $imgThumb.attr( 'alt' ) )
								{
									this.$title.html( $imgThumb.attr( 'alt' ) ).removeClass( 'before' ).removeClass( 'after' );
									this.jGallery.$element.addClass( 'has-title' );
								}
								else { this.jGallery.$element.removeClass( 'has-title' ); }
								this.setJGalleryColoursForActiveThumb();
								this.$element.find( '.pt-page.init' ).css( { visibility: 'visible' } );
								this.$element.find( 'img.prev-img' ).removeClass( 'prev-img' );
								this.advancedAnimation.show( $active.eq( 0 ).parent().parent(), {
									animation: this.$element.find( '.pt-part' ).eq( 0 ).find( '.pt-page-current:not(.pt-page-prev)' ).length === 1
								} );
								this.refreshSize();
								this.thumbnails.refreshNavigation();
								if ( this.booSlideshowPlayed ) { this.slideshowSetTimeout(); }
								this.jGallery.options.afterLoadPhoto( $a, $imgThumb );
								this.booLoadingInProgress = false;
								if ( this.jGallery.options.autostart && this.jGallery.options.slideshowAutostart && this.jGallery.options.slideshow )
								{
									this.jGallery.options.slideshowAutostart = false;
									this.slideshowPlay();
								}
								if ( this.jGallery.options.draggableZoom )
								{
									this.$dragNav.html( '<img src="' + $active.attr( 'src' ) + '" class="bg">\
										<div class="crop"><img src="' + $active.attr( 'src' ) + '"></div>' );
									this.$dragNavCrop = this.$dragNav.find( '.crop' );
									this.$dragNavCropImg = this.$dragNavCrop.find( 'img' );
									this.refreshDragNavCropSize();
								}
								if ( options.historyPushState && this.jGallery.options.browserHistory ) { historyPushState( { path: $active.attr( 'src' ) } ); }
							},
							showPhotoByPath: function( path ) {
								var $a = this.thumbnails.$albums.filter( '.active' ).find( 'a[href="' + path + '"]' );
								if ( $a.length === 0 ) { $a = this.thumbnails.$a.filter( 'a[href="' + path + '"]' ).eq( 0 ); }
								if ( $a.length === 0 ) { return; }
								this.showPhoto( $a, { historyPushState: false } );
							},
							setJGalleryColoursForActiveThumb: function() {
								var $imgThumb = this.thumbnails.$a.filter( '.active' ).find( 'img' );
								this.jGallery.setColours( {
									strBg: $imgThumb.is( '[data-jgallery-bg-color]' ) ? $imgThumb.attr( 'data-jgallery-bg-color' ) : this.jGallery.options.backgroundColor,
									strText: $imgThumb.is( '[data-jgallery-bg-color]' ) ? $imgThumb.attr( 'data-jgallery-text-color' ) : this.jGallery.options.textColor
								} );
							},
							setTransition: function( transition ) {
								this.jGallery.options.hideEffect = jGalleryTransitions[ transition ][ 0 ];
								this.jGallery.options.showEffect = jGalleryTransitions[ transition ][ 1 ];
								this.advancedAnimation.setHideEffect( this.jGallery.options.hideEffect );
								this.advancedAnimation.setShowEffect( this.jGallery.options.showEffect );
							},
							setRandomTransition: function() {
								var rand;
								this.$element.find( '.pt-page' )
									.removeClass( this.jGallery.options.hideEffect )
									.removeClass( this.jGallery.options.showEffect );
								rand = Math.floor( ( Math.random() * jGalleryArrayTransitions.length ) );
								this.jGallery.options.hideEffect = jGalleryArrayTransitions[ rand ][ 0 ];
								this.jGallery.options.showEffect = jGalleryArrayTransitions[ rand ][ 1 ];
								this.advancedAnimation.setHideEffect( this.jGallery.options.hideEffect );
								this.advancedAnimation.setShowEffect( this.jGallery.options.showEffect );
							},
							unmarkActive: function() { this.$element.find( 'img.active' ).removeClass( 'active' ); },
							changeMode: function() {
								var currentMode = this.jGallery.options.mode;
								if ( currentMode === 'slider' ) { return; }
								if ( currentMode === 'standard' ) { this.goToFullScreenMode(); } else if ( currentMode === 'full-screen' ) { this.goToStandardMode(); }
								if ( this.jGallery.iconChangeAlbum instanceof IconChangeAlbum ) { this.jGallery.iconChangeAlbum.refreshMenuHeight(); }
							},
							goToFullScreenMode: function() {
								$body.css( { overflow: 'hidden' } );
								this.jGallery.$this.show();
								this.jGallery.$element.removeClass( 'jgallery-standard' ).addClass( 'jgallery-full-screen' ).css( { width: 'auto', height: 'auto' } );
								this.$changeMode.removeClass( 'totalsoft-expand' ).addClass( 'totalsoft-compress' );
								this.jGallery.options.mode = 'full-screen';
								this.jGallery.refreshDimensions();
							},
							goToStandardMode: function() {
								$body.css( { overflow: 'visible' } );
								this.jGallery.$this.hide();
								this.jGallery.$element.removeClass( 'jgallery-full-screen' ).addClass( 'jgallery-standard' ).css( {
									width: this.jGallery.options.width,
									height: this.jGallery.options.height
								} );
								this.$changeMode.removeClass( 'totalsoft-compress' ).addClass( 'totalsoft-expand' );
								this.jGallery.options.mode = 'standard';
								this.jGallery.refreshDimensions();
							}
						};
						return Zoom;
					} )( jLoader, overlay, historyPushState, jGalleryTransitions, jGalleryArrayTransitions, jGalleryBackwardTransitions, AdvancedAnimation, IconChangeAlbum );
					var JGallery = ( function( outerHtml, historyPushState, isInternetExplorer, isInternetExplorer8AndOlder, refreshHTMLClasses, defaults, defaultsFullScreenMode, defaultsSliderMode, requiredFullScreenMode, requiredSliderMode, IconChangeAlbum, Progress, Thumbnails, ThumbnailsGenerator, Zoom ) {
						var $ = jQuery;
						var $html = $( 'html' );
						var $head = $( 'head' );
						var $body = $( 'body' );
						var $window = $( window );
						$.fn.outerHtml = outerHtml;
						var JGallery = function( $this, jGalleryId, options ) {
							var self = this;
							if ( ! jGalleryId || $this.is( '[data-jgallery-id]' ) ) { return; }
							this.$this = $this;
							this.intId = jGalleryId;
							this.$this.attr( 'data-jgallery-id', this.intId );
							this.overrideOptions( options );
							this.booIsAlbums = $this.find( '.album:has(a:has(img))' ).length > 1;
							if ( this.options.disabledOnIE8AndOlder && isInternetExplorer8AndOlder() ) { return; }
							this.init( {
								success: function() {
									if ( self.options.browserHistory ) { self.browserHistory(); }
									if ( self.options.autostart ) { self.autostart(); }
									refreshHTMLClasses();
									$html.on( {
										keydown: function( event ) {
											if ( self.$element.is( ':visible' ) )
											{
												if ( event.which === 27 )
												{
													event.preventDefault();
													if ( self.thumbnails.getElement().is( '.full-screen' ) ) { self.thumbnails.changeViewToBar(); self.zoom.refreshSize(); return; }
													self.hide();
												}
												if ( event.which === 37 ) { event.preventDefault(); self.zoom.showPrevPhoto(); }
												if ( event.which === 39 ) { event.preventDefault(); self.zoom.showNextPhoto(); }
											}
										}
									} );
								}
							} );
						};
						JGallery.prototype = {
							template: {
								html: '<div class="jgallery" style="display: none;">\
					                        <div class="jgallery-thumbnails hidden">\
					                            <div class="jgallery-container"><div class="jgallery-container-inner"></div></div>\
					                            <span class="prev jgallery-btn"><span class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?>-left ico"></span></span>\
					                            <span class="next jgallery-btn"><span class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?>-right ico"></span></span>\
					                        </div>\
					                        <div class="zoom-container">\
					                            <div class="zoom before pt-perspective"></div>\
					                            <div class="drag-nav hide"></div>\
					                            <div class="left"></div>\
					                            <div class="right"></div>\
					                            <span class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?>-left prev jgallery-btn jgallery-btn-large"></span>\
					                            <span class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?>-right next jgallery-btn jgallery-btn-large"></span>\
					                            <span class="progress"></span>\
					                            <div class="nav">\
					                                <span class="totalsoft resize jgallery-btn jgallery-btn-small" tooltip-position="bottom right"></span>\
					                                <span class="totalsoft change-mode jgallery-btn jgallery-btn-small" tooltip-position="bottom right"></span>\
					                                <span class="totalsoft totalsoft-times jgallery-close jgallery-btn jgallery-btn-small" tooltip-position="bottom right"></span>\
					                            </div>\
					                            <div class="nav-bottom">\
					                                <div class="icons">\
					                                    <span class="totalsoft totalsoft-play slideshow jgallery-btn jgallery-btn-small"></span>\
					                                    <span class="totalsoft totalsoft-random random jgallery-btn jgallery-btn-small inactive"></span>\
					                                    <span class="totalsoft totalsoft-th full-screen jgallery-btn jgallery-btn-small"></span>\
					                                    <span class="totalsoft totalsoft-ellipsis-h minimalize-thumbnails jgallery-btn jgallery-btn-small"></span>\
					                                </div>\
					                                <div class="title before"></div>\
					                            </div>\
					                        </div>\
					                    </div>',
								done: function( fn ) { fn( this.html ); }
							},
							initialized: function() { return this.$this.is( '[data-jgallery-id]' ); },
							update: function( options ) {
								var self = this;
								this.template.done( function() {
									self.overrideOptions( options ); 
									if ( self.options.disabledOnIE8AndOlder && isInternetExplorer8AndOlder() ) { return; }
									self.booIsAlbums = self.$this.find( '.album:has(a:has(img))' ).length > 1;
									self.zoom.update();
									self.thumbnails.init();
									self.setUserOptions();
									self.reloadThumbnails();
									self.refreshDimensions();
								} );
							},
							overrideOptions: function( options ) {
								var modeIsDefined = typeof options !== 'undefined' && typeof options.mode !== 'undefined';
								this.options = $.extend( {}, defaults, this.options );
								if ( modeIsDefined && options.mode === 'full-screen' ) { this.options = $.extend( {}, this.options, defaultsFullScreenMode, options, requiredFullScreenMode ); }
								else if ( modeIsDefined && options.mode === 'slider' ) { this.options = $.extend( {}, this.options, defaultsSliderMode, options, requiredSliderMode ); }
								else { this.options = $.extend( {}, this.options, options ); }
							},
							reloadThumbnails: function() {
								new ThumbnailsGenerator( this, { thumbsHidden: false } );
								this.generateAlbumsDropdown();
								this.thumbnails.reload();
							},
							setVariables: function() {
								this.$element = $( '.jgallery' ).filter( '[data-jgallery-id="' + this.intId + '"]' );
								this.progress = new Progress( this.$element.find( '.zoom-container' ).children( '.progress' ), this );
								this.zoom = new Zoom( this );
								this.thumbnails = new Thumbnails( this );
								this.zoom.setThumbnails( this.thumbnails );
							},
							show: function() {
								this.$this.hide();
								$window.on( 'resize', { jGallery: this }, this.windowOnResize );
								if ( this.options.mode === 'full-screen' )
								{
									this.bodyOverflowBeforeShow = $body.css( 'overflow' );
									$body.css( { 'overflow': 'hidden' } );
								}
								this.$element.not( ':visible' ).removeClass( 'hidden' ).stop( false, true ).fadeIn( 500 );
								this.zoom.refreshContainerSize();
								this.zoom.$title.removeClass( 'hidden' );
								this.options.showGallery();
								if ( this.iconChangeAlbum instanceof IconChangeAlbum ) { this.iconChangeAlbum.refreshMenuHeight(); }
								refreshHTMLClasses();
							},
							hide: function( options ) {
								var self = this;
								if ( ! this.options.canClose ) { return; }
								options = $.extend( {}, { historyPushState: true }, options );
								this.$element.filter( ':visible' ).stop( false, true ).addClass( 'hidden' ).fadeOut( 500, function() {
									if ( self.options.mode === 'full-screen' ) { $body.css( { 'overflow': self.bodyOverflowBeforeShow } ); }
									refreshHTMLClasses();
								} );
								this.zoom.booLoadingInProgress = false;
								clearTimeout( this.zoom.showPhotoTimeout );
								this.zoom.$title.addClass( 'hidden' );
								this.zoom.$btnPrev.addClass( 'hidden' );
								this.zoom.$btnNext.addClass( 'hidden' );
								this.zoom.slideshowPause();
								this.zoom.advancedAnimation.hideActive();
								this.zoom.unmarkActive();
								$window.off( 'resize', this.windowOnResize );
								this.$this.show();
								if ( options.historyPushState && this.options.browserHistory ) { historyPushState(); }
								this.options.closeGallery();
							},
							autostart: function() {
								var $album;
								var $thumb;
								if ( this.$element.is( ':visible' ) ) { return; }
								if ( this.booIsAlbums )
								{
									$album = this.thumbnails.getElement().find( '.album' ).eq( this.options.autostartAtAlbum - 1 );
									if ( $album.length === 0 ) { $album = this.thumbnails.getElement().find( '.album' ).eq( 0 ); }
								}
								else { $album = this.thumbnails.getElement(); }
								$thumb = $album.find( 'a' ).eq( this.options.autostartAtImage - 1 );
								if ( $thumb.length === 0 ) { $thumb = $album.find( 'a' ).eq( 0 ); }
								$thumb.trigger( 'click' );
							},
							browserHistory: function() {
								var self = this;
								var windowOnPopState = window.onpopstate;
								function callActionByUrl() {
									var hash;
									if ( ! document.location.hash ) { return; }
									hash = document.location.hash.replace( '#', '' );
									switch ( hash ) {
										case '':
											self.hide( { historyPushState: false } );
											break;
										default:
											self.zoom.showPhotoByPath( hash );
									}
								}
								window.onpopstate = function() { if ( typeof windowOnPopState === 'function' ) { windowOnPopState(); } callActionByUrl(); };
								if ( this.options.autostart ) { callActionByUrl(); }
							},
							generateAlbumsDropdown: function() {
								var self = this;
								this.$element.find( '.change-album' ).remove();
								if ( ! this.booIsAlbums ) { return; }
								this.zoom.$container.find( '.nav-bottom > .icons' ).append( '\
									<span class="totalsoft totalsoft-list-ul change-album jgallery-btn jgallery-btn-small" tooltip="' + self.options.tooltipSeeOtherAlbums + '">\
										<span class="menu jgallery-btn"></span>\
										<span class="title"></span>\
									</span>\
								' );
								this.iconChangeAlbum = new IconChangeAlbum( self.zoom.$container.find( '.change-album' ), this );
								this.iconChangeAlbum.clearMenu();
								this.thumbnails.$albums.each( function() {
								var strTitle = $( this ).attr( 'data-jgallery-album-title' );
									self.iconChangeAlbum.appendToMenu( '<span class="item" data-jgallery-album-title="' + strTitle + '">' + strTitle + '</span>' );
								} );
								this.thumbnails.getElement().append( this.iconChangeAlbum.getElement().outerHtml() );
								this.iconChangeAlbum = new IconChangeAlbum( this.iconChangeAlbum.getElement().add( this.thumbnails.getElement().children( ':last-child' ) ), this );
								this.iconChangeAlbum.bindEvents( this );
							},
							init: function( options ) {
								var self = this;
								options = $.extend( { success: function(){} }, options );
								$head.append( '<style type="text/css" class="colours" data-jgallery-id="' + this.intId + '"></style>' );
								this.options.initGallery();
								this.generateHtml( {
									success: function() {
										new ThumbnailsGenerator( self );
										self.setVariables();
										self.thumbnails.init();
										self.thumbnails.getElement().append( '<span class="totalsoft totalsoft-times jgallery-btn jgallery-close jgallery-btn-small"></span>' );
										self.generateAlbumsDropdown();
										self.setUserOptions();
										if ( self.options.zoomSize === 'fit' || self.options.zoomSize === 'original' ) { self.zoom.$resize.addClass( 'totalsoft-search-plus' ); }
										if ( self.options.zoomSize === 'fill' ) { self.zoom.$resize.addClass( 'totalsoft-search-minus' ); }
										if ( ! isInternetExplorer() ) { self.$element.addClass( 'text-shadow' ); }
										self.thumbnails.refreshNavigation();
										self.zoom.refreshNav();
										self.zoom.refreshSize();
										self.$this.on( 'click', 'a:has(img)', function( event ) { var $this = $( this ); event.preventDefault(); self.zoom.showPhoto( $this ); } );
										self.thumbnails.$element.on( 'click', 'a', function( event ) {
											var $this = $( this );
											event.preventDefault();
											if ( $this.is( ':not(.active)' ) ) { self.zoom.slideshowStop(); self.zoom.showPhoto( $this ); }
											else if ( self.thumbnails.isFullScreen() ) { self.thumbnails.changeViewToBar(); self.zoom.refreshSize(); }
										} );
										self.zoom.$btnPrev.add( self.zoom.$container.find( '.left' ) ).on( { click: function() { self.zoom.slideshowStop(); self.zoom.showPrevPhoto(); } } );
										self.zoom.$btnNext.add( self.zoom.$container.find( '.right' ) ).on( { click: function() { self.zoom.slideshowStop(); self.zoom.showNextPhoto(); } } );
										self.zoom.$container.find( '.jgallery-close' ).on( { click: function() { self.hide(); } } );
										self.zoom.$random.on( { click: function() { self.zoom.slideshowRandomToggle(); } } );
										self.zoom.$resize.on( { click: function() { self.zoom.changeSize(); self.zoom.slideshowPause(); } } );
										self.zoom.$changeMode.on( { click: function() { self.zoom.changeMode(); } } );
										self.zoom.$slideshow.on( { click: function() { self.zoom.slideshowPlayPause(); } } );
										self.zoom.$container.find( '.minimalize-thumbnails' ).on( { click: function() { self.thumbnails.toggle(); self.zoom.refreshSize(); } } );
										self.thumbnails.bindEvents();
										options.success();
										if ( self.options.hideThumbnailsOnInit ) { self.zoom.$container.find( '.minimalize-thumbnails' ).addClass( 'inactive' ); }
									}
								} );
								this.refreshCssClassJGalleryMobile();
							},
							isSlider: function() { return this.options.mode === 'slider'; },
							windowOnResize: function( event ) {
								var jGallery = event.data.jGallery;
								jGallery.refreshThumbnailsVisibility();
								jGallery.refreshCssClassJGalleryMobile();
							},
							refreshCssClassJGalleryMobile: function() { this.isMobile() ? this.$jgallery.addClass( 'jgallery-mobile' ) : this.$jgallery.removeClass( 'jgallery-mobile' ); },
							refreshDimensions: function() {
								this.zoom.refreshSize();
								if ( this.iconChangeAlbum instanceof IconChangeAlbum ) { this.iconChangeAlbum.refreshMenuHeight(); }
								this.thumbnails.refreshNavigation();
							},
							getCanvasRatioWidthToHeight: function() {
								var intCanvasWidth;
								var intCanvasHeight;
								if ( this.thumbnails.isHorizontal() )
								{
									intCanvasWidth = this.$element.width();
									intCanvasHeight = this.$element.height() - this.thumbnails.getElement().outerHeight( true );
								}
								else if ( this.thumbnails.isVertical() )
								{
									intCanvasWidth = this.$element.width() - this.thumbnails.getElement().outerWidth( true );
									intCanvasHeight = this.$element.height();
								}
								else
								{
									intCanvasWidth = this.$element.width();
									intCanvasHeight = this.$element.height();
								}
								return intCanvasWidth / intCanvasHeight;
							},
							hideThumbnailsBar: function() {
								this.thumbnails.getElement().addClass( 'hidden' );
								this.zoom.$container.find( '.minimalize-thumbnails' ).hide();
							},
							showThumbnailsBar: function() {
								this.thumbnails.getElement().removeClass( 'hidden' );
								this.options.canMinimalizeThumbnails && this.options.thumbnails ? this.zoom.$container.find( '.minimalize-thumbnails' ).show() : this.zoom.$container.find( '.minimalize-thumbnails' ).hide();
							},
							refreshThumbnailsVisibility: function() {
								if ( ! this.isMobile() ) { if ( ! this.options.thumbnails ) { this.hideThumbnailsBar(); } else { this.showThumbnailsBar(); } }
								else { if( this.options.thumbnailsHideOnMobile ) { this.hideThumbnailsBar(); } }
								this.refreshDimensions();
							},
							isMobile: function() { return $window.width() <= this.options.maxMobileWidth; },
							setUserOptions: function() {
								var options = this.options;
								var mode = options.mode;
								var width = mode === 'full-screen' ? 'auto' : options.width;
								var height = mode === 'full-screen' ? 'auto' : options.height;
								this.refreshAttrClasses();
								this.options.canZoom ? this.zoom.$resize.show() : this.zoom.$resize.hide();
								this.options.canChangeMode ? this.zoom.$changeMode.show() : this.zoom.$changeMode.hide();
								this.options.mode === 'standard' ? this.zoom.$changeMode.removeClass( 'totalsoft-compress' ).addClass( 'totalsoft-expand' ) : this.zoom.$changeMode.removeClass( 'totalsoft-expand' ).addClass( 'totalsoft-compress' );
								this.options.canClose ? this.zoom.$container.find( '.jgallery-close' ).show() : this.zoom.$container.find( '.jgallery-close' ).hide();
								this.refreshThumbnailsVisibility();
								this.zoom.refreshSize();
								this.options.slideshow ? this.zoom.$slideshow.show() : this.zoom.$slideshow.hide();
								this.options.slideshow && this.options.slideshowCanRandom && this.options.slideshowAutostart ? this.zoom.$random.show(): this.zoom.$random.hide();
								this.options.slideshow && this.options.slideshowCanRandom && this.options.slideshowRandom ? this.zoom.$random.addClass( 'active' ) : this.zoom.$random.removeClass( 'active' );
								this.options.thumbnailsFullScreen && this.options.thumbnails ? this.zoom.$container.find( '.full-screen' ).show() : this.zoom.$container.find( '.full-screen' ).hide();
								this.options.hideThumbnailsOnInit && this.options.thumbnails ? this.thumbnails.hide() : this.thumbnails.show();
								this.options.titleExpanded ? this.zoom.$title.addClass( 'expanded' ) : this.zoom.$title.removeClass( 'expanded' );
								this.setColours( { strBg: this.options.backgroundColor, strText: this.options.textColor } );
								this.options.tooltips ? this.$jgallery.addClass( 'jgallery-tooltips' ) : this.$jgallery.removeClass( 'jgallery-tooltips' );
								this.$jgallery.css( { width: width, height: height } );
								this.options.draggableZoomHideNavigationOnMobile ? this.$jgallery.addClass( 'jgallery-hide-draggable-navigation-on-mobile' ) : this.$jgallery.removeClass( 'jgallery-hide-draggable-navigation-on-mobile' );
							},
							refreshAttrClasses: function() {
								var self = this;
								var modes = [ 'standard', 'full-screen', 'slider' ];
								$.each( modes, function( key, value ) { self.$jgallery.removeClass( 'jgallery-' + value ); } );
								this.$jgallery.addClass( 'jgallery-' + this.options.mode );
							},
							setColours: function( options ) { $head.find( 'style[data-jgallery-id="' + this.intId + '"].colours' ).html( this.getCssForColours( options ) ); },
							generateHtml: function( options ) {
								var self = this;
								options = $.extend( {}, { success: function(){} }, options );
								this.template.done( function( html ) {
									( function() {
										var options = self.options;
										var mode = options.mode;
										if ( mode === 'full-screen' ) { self.$jgallery = self.$this.after( html ).next(); }
										else { if ( options.autostart ) { self.$this.hide(); }
										self.$jgallery = self.$this.after( html ).next(); }
										self.$jgallery.addClass( 'jgallery-' + mode ).attr( 'data-jgallery-id', self.intId );
										self.$jgallery.find( '.totalsoft.slideshow' ).attr( 'tooltip', options.tooltipSlideshow );
										self.$jgallery.find( '.totalsoft.resize' ).attr( 'tooltip', options.tooltipZoom );
										self.$jgallery.find( '.totalsoft.change-mode' ).attr( 'tooltip', options.tooltipFullScreen );
										self.$jgallery.find( '.totalsoft.jgallery-close' ).attr( 'tooltip', options.tooltipClose );
										self.$jgallery.find( '.totalsoft.random' ).attr( 'tooltip', options.tooltipRandom );
										self.$jgallery.find( '.totalsoft.full-screen' ).attr( 'tooltip', options.tooltipSeeAllPhotos );
										self.$jgallery.find( '.totalsoft.minimalize-thumbnails' ).attr( 'tooltip', options.tooltipToggleThumbnails );
									} )();
									options.success();
								} );
							},
							getCssForColours: function( objOptions ) {
								objOptions = $.extend( { strBg: 'rgb( 0, 0, 0 )', strText: 'rgb( 255, 255, 255 )' }, objOptions );
								var arrText;
								var arrBg;
								var arrBgAlt;
								if ( typeof tinycolor === 'function' )
								{
									arrText = tinycolor( objOptions.strText ).toRgb();
									arrBg = tinycolor( objOptions.strBg ).toRgb();
									if ( arrBg.r + arrBg.g + arrBg.b > 375 ) { arrBg = tinycolor.darken( objOptions.strBg ).toRgb(); arrBgAlt = tinycolor( objOptions.strBg ).toRgb(); }
									else { arrBg = tinycolor( objOptions.strBg ).toRgb(); arrBgAlt = tinycolor.lighten( objOptions.strBg ).toRgb(); }
								}
								else { arrBg = { r: 230, g: 230, b: 230 }; arrBgAlt = { r: 255, g: 255, b: 255 }; arrText = { r: 0, g: 0, b: 0 }; }
								return '\
									.jgallery[data-jgallery-id="' + this.intId + '"].jgallery-standard {\
										background: transparent !important;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"].jgallery-full-screen {\
										background: #ffffff !important;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] [tooltip]:after {\
										background: rgba(' + arrText.r + ',' + arrText.g + ', ' + arrText.b + ', .9);\
										color: rgb(' + arrBg.r + ',' + arrBg.g + ', ' + arrBg.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-btn.totalsoft-search-plus{\
										color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-btn.totalsoft-expand{\
										color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-btn.totalsoft-play, .jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-btn.totalsoft-pause{\
										color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-btn.totalsoft-list-ul{\
										color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-btn.next, .jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-btn.prev{\
										color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-btn:hover {\
										opacity: 0.8;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .change-album .menu {\
										background: rgb(' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .zoom-container .nav-bottom .change-album > .title {\
										background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;\
										color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;\
										font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?>px;\
										font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .full-screen .change-album .menu {\
										background: rgb(' + arrBg.r + ',' + arrBg.g + ', ' + arrBg.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .change-album .menu .item {\
										border-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;\
										color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;\
										background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .full-screen .change-album .menu .item {\
										border-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;\
										color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;\
										background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .change-album .menu .item.active,\
									.jgallery[data-jgallery-id="' + this.intId + '"] .change-album .menu .item:hover {\
										background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>;\
										color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .zoom-container:not([data-size="fill"]) .jgallery-container {\
										background: transparent;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .zoom-container .nav-bottom {\
										background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .zoom-container .nav-bottom .icons,\
									.jgallery[data-jgallery-id="' + this.intId + '"] .zoom-container .nav-bottom .icons .totalsoft{\
										background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .zoom-container .nav-bottom > .title {\
										color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;\
										font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;\
										font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>px;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .zoom-container .nav-bottom > .title.expanded {\
										background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;\
										opacity:0.5;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .zoom-container .drag-nav {\
										background: rgb(' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ');\
										-webkit-box-shadow: 0 0 0 3px rgba(' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', .5);\
										box-shadow: 0 0 0 3px rgba(' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', .5);\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .zoom-container .drag-nav .crop {\
										-webkit-box-shadow: 0 0 0 3px rgba(' + arrText.r + ',' + arrText.g + ', ' + arrText.b + ', .5);\
										box-shadow: 0 0 0 3px rgba(' + arrText.r + ',' + arrText.g + ', ' + arrText.b + ', .5);\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails {\
										background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_38;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails .ico {\
										color: rgb(' + arrText.r + ',' + arrText.g + ', ' + arrText.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails.full-screen .prev:before {\
										background-image: -webkit-gradient(linear,left 0%,left 100%,from(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 )),to(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0)));\
										background-image: -webkit-linear-gradient(top,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ),0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0),100%);\
										background-image: -moz-linear-gradient(top,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0) 100%);\
										background-image: linear-gradient(to bottom,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0) 100%);\
										background-repeat: repeat-x;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails.full-screen .next:before {\
										background-image: -webkit-gradient(linear,left 0%,left 100%,from(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0)),to(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1)));\
										background-image: -webkit-linear-gradient(top,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0),0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1),100%);\
										background-image: -moz-linear-gradient(top,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1) 100%);\
										background-image: linear-gradient(to bottom,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1) 100%);\
										background-repeat: repeat-x;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails.images a:after {\
										background: rgb(' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails.full-screen .prev,\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails.full-screen .next {\
										background: rgb(' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails.square:not(.full-screen) a {\
										background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>;\
										color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .overlayContainer .overlay {\
										background: rgba(' + arrBg.r + ',' + arrBg.g + ', ' + arrBg.b + ',.8);\
										color: rgb(' + arrText.r + ',' + arrText.g + ', ' + arrText.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .overlayContainer .imageLoaderPositionAbsolute:after {\
										border-color: rgba(' + arrText.r + ',' + arrText.g + ', ' + arrText.b + ', .5 );\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails .overlayContainer .overlay {\
										background: rgb(' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails-horizontal .prev {\
										background: rgb(' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails-horizontal .prev:before {\
										background-image: -webkit-gradient(linear,0% top,100% top,from(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 )),to(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 )));\
										background-image: -webkit-linear-gradient(left,color-stop(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 0%),color-stop(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ) 100%));\
										background-image: -moz-linear-gradient(left,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ) 100%);\
										background-image: linear-gradient(to right,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ) 100%);\
										background-repeat: repeat-x;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails-horizontal .next {\
										background: rgb(' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails-horizontal .next:before {\
										background-image: -webkit-gradient(linear,0% top,100% top,from(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 )),to(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 )));\
										background-image: -webkit-linear-gradient(left,color-stop(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ) 0%),color-stop(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 100%));\
										background-image: -moz-linear-gradient(left,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 100%);\
										background-image: linear-gradient(to right,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 100%);\
										background-repeat: repeat-x;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails-vertical .prev {\
										background: rgb(' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails-vertical .prev:before {\
										background-image: -webkit-gradient(linear,left 0%,left 100%,from(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 )),to(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 )));\
										background-image: -webkit-linear-gradient(top,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ),0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ),100%);\
										background-image: -moz-linear-gradient(top,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ) 100%);\
										background-image: linear-gradient(to bottom,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ) 100%);\
										background-repeat: repeat-x;\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails-vertical .next {\
										background: rgb(' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ');\
									}\
									.jgallery[data-jgallery-id="' + this.intId + '"] .jgallery-thumbnails-vertical .next:before {\
										background-image: -webkit-gradient(linear,left 0%,left 100%,from(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 )),to(rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 )));\
										background-image: -webkit-linear-gradient(top,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ),0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ),100%);\
										background-image: -moz-linear-gradient(top,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 100%);\
										background-image: linear-gradient(to bottom,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 0 ) 0%,rgba( ' + arrBgAlt.r + ',' + arrBgAlt.g + ', ' + arrBgAlt.b + ', 1 ) 100%);\
										background-repeat: repeat-x;\
									}\
									.jgallery.jgallery-slider[data-jgallery-id="' + this.intId + '"] .zoom-container .nav-bottom,\
									.jgallery.jgallery-slider[data-jgallery-id="' + this.intId + '"] .zoom-container .nav-bottom > .title.expanded {\
										background: none;\
									}\
									.jgallery.has-title.jgallery-slider[data-jgallery-id="' + this.intId + '"] .zoom-container .nav-bottom,\
									.jgallery.has-title.jgallery-slider[data-jgallery-id="' + this.intId + '"] .zoom-container .nav-bottom > .title.expanded {\
										background: rgba(' + arrBg.r + ',' + arrBg.g + ', ' + arrBg.b + ',.7);\
										color: rgb(' + arrText.r + ',' + arrText.g + ', ' + arrText.b + ');\
									}\
									.jgallery.jgallery-slider[data-jgallery-id="' + this.intId + '"] .zoom-container .nav-bottom .jgallery-btn {\
										background: rgba(' + arrBg.r + ',' + arrBg.g + ', ' + arrBg.b + ',.8);\
										color: rgb(' + arrText.r + ',' + arrText.g + ', ' + arrText.b + ');\
									}\
								';
							}
						};
						return JGallery;
					} )( outerHtml, historyPushState, isInternetExplorer, isInternetExplorer8AndOlder, refreshHTMLClasses, defaults, defaultsFullScreenMode, defaultsSliderMode, requiredFullScreenMode, requiredSliderMode, IconChangeAlbum, Progress, Thumbnails, ThumbnailsGenerator, Zoom );
					( function( refreshHTMLClasses, defaults, jGalleryTransitions, JGallery ) {
						var jGalleryCollection = [ '' ];
						var $ = jQuery;
						var $html = $( 'html' );
						var jGalleryId = <?php echo $Total_Soft_Portfolio;?>;
						$.fn.jGallery = function( userOptions ) {
							var self = this;
							this.each( function() {
								var $this = $( this );
								if ( ! $this.is( '[data-jgallery-id]' ) ) { jGalleryCollection[ jGalleryId ] = new JGallery( $this, jGalleryId, userOptions ); }
								else if( $.isPlainObject( userOptions ) ) { jGalleryCollection[ $this.attr( 'data-jgallery-id' ) ].update( userOptions ); }
							} );
							$.extend( self, {
								getDefaults: function() { return defaults; },
								getTransitions: function() { return jGalleryTransitions; },
								restoreDefaults: function() { return self.each( function() { $( this ).jGallery( defaults ); } ); },
								getOptions: function() { return jGalleryCollection[$( self ).eq( 0 ).attr( 'data-jgallery-id' )].options; },
								destroy: function() {
									return self.each( function() {
										var $this = $( this );
										var id = $this.attr( 'data-jgallery-id' );
										jGalleryCollection[ id ] = '';
										$this.removeAttr( 'data-jgallery-id' ).show();
										$html.find( '.jgallery[data-jgallery-id="' + id + '"]' ).remove();
										refreshHTMLClasses();
									} );
								}
							} );
							return this;
						};
					} )( refreshHTMLClasses, defaults, jGalleryTransitions, JGallery ); } )();
				</script>
			<?php } else if($TotalSoftPortfolioOpt[0]->TotalSoftPortfolio_SetType == 'Gallery Album Animation'){ ?>
				<style type="text/css">
					#TS_Portfolio_GAA<?php echo $Total_Soft_Portfolio;?> { float: left; width: 100%; }
					#TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?> { width: 100%; position: relative; margin-right: auto; margin-left: auto; }
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content { float: left; width: 100%;	margin-bottom: 10px; position: relative; }
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content:nth-last-child(1) { margin-bottom: 20px !important; }
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-text
					{
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02 == 'Position 1'){ ?>
							float: left;
							width: calc(99% - <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05;?>px);
							max-width: 100%;
						<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02 == 'Position 2'){ ?>
							margin: 0 auto !important;
							width: 100%;
						<?php }?>
					}
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-text p { margin: 0; }
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content_titlea
					{
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
						text-align: center;
						cursor: default;
						width: 100%;
						box-sizing:border-box;
						padding: 5px 10px;
						border: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09;?>px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?>;
						margin: 10px auto;
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>px;
						font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12;?>;
						line-height: 1;
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08 == 'true'){ ?>
							border-radius: 15px;
						<?php }?>
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type 1'){ ?>
							background: transparent !important;
						<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type 2'){ ?>
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
						<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type 3'){ ?>
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
							background: -webkit-linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
							background: -o-linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
							background: -moz-linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
							background: linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type04'){ ?>
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
							background: -webkit-linear-gradient(left, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
							background: -o-linear-gradient(right, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
							background: -moz-linear-gradient(right, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
							background: linear-gradient(to right, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type05'){ ?>
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
							background: -webkit-linear-gradient(left top, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
							background: -o-linear-gradient(bottom right, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
							background: -moz-linear-gradient(bottom right, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
							background: linear-gradient(to bottom right, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type06'){ ?>
							background: -webkit-linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: -o-linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: -moz-linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type07'){ ?>
							background: -webkit-linear-gradient(left, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: -o-linear-gradient(left, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: -moz-linear-gradient(left, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: linear-gradient(to right, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type08'){ ?>
							background: -webkit-repeating-linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, 10%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%);
							background: -o-repeating-linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, 10%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%);
							background: -moz-repeating-linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, 10%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%);
							background: repeating-linear-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, 10%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type09'){ ?>
							background: -webkit-repeating-linear-gradient(45deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
							background: -o-repeating-linear-gradient(45deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
							background: -moz-repeating-linear-gradient(45deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
							background: repeating-linear-gradient(45deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type10'){ ?>
							background: -webkit-repeating-linear-gradient(190deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
							background: -o-repeating-linear-gradient(190deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
							background: -moz-repeating-linear-gradient(190deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
							background: repeating-linear-gradient(190deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type11'){ ?>
							background: -webkit-repeating-linear-gradient(90deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
							background: -o-repeating-linear-gradient(90deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
							background: -moz-repeating-linear-gradient(90deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
							background: repeating-linear-gradient(90deg,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 7%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 10%);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type12'){ ?>
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
							background: -webkit-radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: -o-radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: -moz-radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type13'){ ?>
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
							background: -webkit-radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 5%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 15%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 60%);
							background: -o-radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 5%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 15%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 60%);
							background: -moz-radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 5%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 15%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 60%);
							background: radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 5%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 15%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 60%);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type14'){ ?>
							background: -webkit-radial-gradient(circle, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: -o-radial-gradient(circle, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: -moz-radial-gradient(circle, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
							background: radial-gradient(circle, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>);
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'Type15'){ ?>
							background: -webkit-repeating-radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 10%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 15%);
							background: -o-repeating-radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 10%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 15%);
							background: -moz-repeating-radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 10%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 15%);
							background: repeating-radial-gradient(<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 10%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 15%);
						<?php }?>
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13 == 'true'){ ?>
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 == 'true'){ ?>
								-moz-box-shadow: 0px 0px 15px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>;
								-webkit-box-shadow: 0px 0px 15px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>;
								box-shadow: 0px 0px 15px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>;
							<?php } else { ?>
								-moz-box-shadow: 0px 7px 20px -10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>;
								-webkit-box-shadow: 0px 7px 20px -10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>;
								box-shadow: 0px 7px 20px -10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15;?>;
							<?php }?>
						<?php }?>
					}
					.TS_Portfolio_GAA_IFOP<?php echo $Total_Soft_Portfolio;?>:before
					{
						content: '\<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>' !important;
					}
					#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?> { position: fixed; z-index: 1000000; left: 0px; top: 0px; height: 100%; width: 100%; -webkit-touch-callout: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; display: none; }
					#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner { position: relative; height: 100%; width: 100%; float: left; background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>; }
					.TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-button1
					{
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29 == 'Size 1'){ ?>
							height: 35px; width: 35px; font-size: 18px; line-height: 35px;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29 == 'Size 2'){ ?>
							height: 45px; width: 45px; font-size: 23px; line-height: 45px;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29 == 'Size 3'){ ?>
							height: 60px; width: 60px; font-size: 30px; line-height: 60px;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29 == 'Size 4'){ ?>
							height: 80px; width: 80px; font-size: 40px; line-height: 80px;
						<?php }?>
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31 == 'true'){ ?>
							-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;
						<?php }?>
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>; position: absolute; color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>; text-align: center; -webkit-transition: all 0.5s; -moz-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s; z-index: 20;
					}
					.TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-button1:hover { background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>; color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>; cursor: pointer; -webkit-border-radius: 35%; -moz-border-radius: 35%; border-radius: 35%; }
					.TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-button2
					{
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36 == 'Size 1'){ ?>
							height: 35px; width: 35px; font-size: 18px; line-height: 35px;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36 == 'Size 2'){ ?>
							height: 45px; width: 45px; font-size: 23px; line-height: 45px;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36 == 'Size 3'){ ?>
							height: 60px; width: 60px; font-size: 30px; line-height: 60px;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36 == 'Size 4'){ ?>
							height: 80px; width: 80px; font-size: 40px; line-height: 80px;
						<?php }?>
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_38 == 'true'){ ?>
							-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;
						<?php }?>
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>; position: absolute; color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?>; text-align: center; -webkit-transition: all 0.5s; -moz-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s; z-index: 1000; 
					}
					.TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-button2:hover { background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39;?>; color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?>; cursor: pointer; -webkit-border-radius: 35%; -moz-border-radius: 35%; border-radius: 35%; }
					#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-left { left: 20px; top: 50%; margin-top: -17.5px; }
					#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-right { top: 50%; right: 20px; margin-top: -17.5px; }
					#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-close { top: 0px; right: 0px; margin-top: 20px; margin-right: 20px; }
					#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-close span:before { content: '\<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34;?>'; }
					#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image { height: 667px; width: 1000px; margin-left: auto; margin-right: auto; margin-top: 50px; position: relative; }
					#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img { position: absolute; left: 50%; top: 50%; -webkit-transition: all 0.5s; -moz-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s; -ms-transform: scale(1.5,1.5); -webkit-transform: scale(1.5,1.5); transform: scale(1.5,1.5); opacity: 0; }
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image
					{
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02 == 'Position 1'){ ?>
							float: left;
						<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02 == 'Position 2'){ ?>
							margin: 0 auto;
						<?php }?>
						width: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05;?>px;
						position: relative;
						height: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>px;
						-webkit-perspective: 800px; -moz-perspective: 800px; -o-perspective: 800px; -ms-perspective: 800px; perspective: 800px;
					}
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img { width: 100%; height: 100%; position: absolute; left: 0px; top: 0px; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; -o-transition: all 0.3s; transition: all 0.3s; opacity: 0; }
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover { height: 100%; width: 100%; position: absolute; left: 0px; top: 0px; background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>; cursor: pointer; opacity: 0; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; -o-transition: all 0.3s; transition: all 0.3s; z-index: 1;}
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover-cercle
					{
						position: absolute; left: 50%; top: 50%;
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21 == 'Size 1'){ ?>
							height: 30px; width: 30px; font-size: 15px; line-height: 30px; margin-top: -15px; margin-left: -15px;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21 == 'Size 2'){ ?>
							height: 50px; width: 50px; font-size: 25px; line-height: 50px; margin-top: -25px; margin-left: -25px;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21 == 'Size 3'){ ?>
							height: 66px; width: 66px; font-size: 33px; line-height: 66px; margin-top: -33px; margin-left: -33px;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21 == 'Size 4'){ ?>
							height: 80px; width: 80px; font-size: 40px; line-height: 80px; margin-top: -40px; margin-left: -40px;
						<?php }?>
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23 == 'true'){ ?>
							-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;
						<?php }?>
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?>; color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>; text-align: center; -webkit-transform-origin: center; transform-origin: center; -webkit-animation-duration: 1s; animation-duration: 1s; -webkit-animation-fill-mode: both; animation-fill-mode: both; 
					}
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover-cercle:hover { background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>; color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>; }
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover .TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover-cercle { -webkit-animation-name: jello; animation-name: jello; }
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover { border: none !important; box-shadow: none !important; <?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02 == 'Position 1'){ ?> margin: 0 !important; <?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02 == 'Position 2'){ ?> margin: 0 auto !important; <?php }?> padding: 0 !important; }
					.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img{ border: none !important; box-shadow: none !important; margin: 0 !important; padding: 0 !important; }
					@-webkit-keyframes jello
					{
						from, 11.1%, to { -webkit-transform: none; transform: none; }
						22.2% { -webkit-transform: skewX(-12.5deg) skewY(-12.5deg); transform: skewX(-12.5deg) skewY(-12.5deg); }
						33.3% { -webkit-transform: skewX(6.25deg) skewY(6.25deg); transform: skewX(6.25deg) skewY(6.25deg); }
						44.4% { -webkit-transform: skewX(-3.125deg) skewY(-3.125deg); transform: skewX(-3.125deg) skewY(-3.125deg); }
						55.5% { -webkit-transform: skewX(1.5625deg) skewY(1.5625deg); transform: skewX(1.5625deg) skewY(1.5625deg); }
						66.6% { -webkit-transform: skewX(-0.78125deg) skewY(-0.78125deg); transform: skewX(-0.78125deg) skewY(-0.78125deg); }
						77.7% { -webkit-transform: skewX(0.390625deg) skewY(0.390625deg); transform: skewX(0.390625deg) skewY(0.390625deg); }
						88.8% { -webkit-transform: skewX(-0.1953125deg) skewY(-0.1953125deg); transform: skewX(-0.1953125deg) skewY(-0.1953125deg); }
					}
					@keyframes jello
					{
						from, 11.1%, to { -webkit-transform: none; transform: none; }
						22.2% { -webkit-transform: skewX(-12.5deg) skewY(-12.5deg); transform: skewX(-12.5deg) skewY(-12.5deg); }
						33.3% { -webkit-transform: skewX(6.25deg) skewY(6.25deg); transform: skewX(6.25deg) skewY(6.25deg); }
						44.4% { -webkit-transform: skewX(-3.125deg) skewY(-3.125deg); transform: skewX(-3.125deg) skewY(-3.125deg); }
						55.5% { -webkit-transform: skewX(1.5625deg) skewY(1.5625deg); transform: skewX(1.5625deg) skewY(1.5625deg); }
						66.6% { -webkit-transform: skewX(-0.78125deg) skewY(-0.78125deg); transform: skewX(-0.78125deg) skewY(-0.78125deg); }
						77.7% { -webkit-transform: skewX(0.390625deg) skewY(0.390625deg); transform: skewX(0.390625deg) skewY(0.390625deg); }
						88.8% { -webkit-transform: skewX(-0.1953125deg) skewY(-0.1953125deg); transform: skewX(-0.1953125deg) skewY(-0.1953125deg); }
					}
					@-webkit-keyframes fadeInDown
					{
						0% { opacity: 0; -webkit-transform: translate3d(0, -100%, 0); transform: translate3d(0, -100%, 0); }
						100% { opacity: 1; -webkit-transform: none; transform: none; }
					}
					@keyframes fadeInDown
					{
						0% { opacity: 0; -webkit-transform: translate3d(0, -100%, 0); transform: translate3d(0, -100%, 0); }
						100% { opacity: 1; -webkit-transform: none; transform: none; }
					}
					.fadeInDown { -webkit-animation-name: fadeInDown; animation-name: fadeInDown; -webkit-animation-delay: 0.3s; animation-delay: 0.3s; -webkit-animation-duration: 0.5s; animation-duration: 0.5s; -webkit-animation-fill-mode: both; animation-fill-mode: both; }
					@-webkit-keyframes fadeOutDown
					{
						0% { opacity: 1; }
						100% { opacity: 0; -webkit-transform: translate3d(0, 100%, 0); transform: translate3d(0, 100%, 0); }
					}
					@keyframes fadeOutDown
					{
						0% { opacity: 1; }
						100% { opacity: 0; -webkit-transform: translate3d(0, 100%, 0); transform: translate3d(0, 100%, 0); }
					}
					.fadeOutDown { -webkit-animation-name: fadeOutDown; animation-name: fadeOutDown; -webkit-animation-duration: 0.5s; animation-duration: 0.5s; -webkit-animation-fill-mode: both; animation-fill-mode: both; }
					@-webkit-keyframes fadeIn { 0% { opacity: 0; } 100% { opacity: 1; } }
					@keyframes fadeIn { 0% { opacity: 0; } 100% { opacity: 1; } }
					.fadeIn { -webkit-animation-name: fadeIn; animation-name: fadeIn; -webkit-animation-duration: 0.5s; animation-duration: 0.5s; -webkit-animation-fill-mode: both; animation-fill-mode: both; }
					@-webkit-keyframes fadeOut { 0% { opacity: 1; } 100% { opacity: 0; } }
					@keyframes fadeOut { 0% { opacity: 1; } 100% { opacity: 0; } }
					.fadeOut { -webkit-animation-name: fadeOut; animation-name: fadeOut; -webkit-animation-duration: 0.5s; animation-duration: 0.5s; -webkit-animation-fill-mode: both; animation-fill-mode: both; }
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01 == 'Effect 1'){ ?>
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(5) { -ms-transform: translate(0,-30%) scale(0.6,0.6); -webkit-transform: translate(0,-30%) scale(0.6,0.6); transform: translate(0,-30%) scale(0.6,0.6); z-index: 1; opacity: 0.2; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(4) { -ms-transform: translate(0,-20%) scale(0.7,0.7); -webkit-transform: translate(0,-20%) scale(0.7,0.7); transform: translate(0,-20%) scale(0.7,0.7); z-index: 1; opacity: 0.4; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(3) { -ms-transform: translate(0,-10%) scale(0.8,0.8); -webkit-transform: translate(0,-10%) scale(0.8,0.8); transform: translate(0,-10%) scale(0.8,0.8); z-index: 2; opacity: 0.6; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(2) { -ms-transform: scale(0.9,0.9) ; -webkit-transform: scale(0.9,0.9); transform: scale(0.9,0.9); z-index: 3; opacity: 0.8; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(1) { -ms-transform: translate(0,10%) scale(1,1); -webkit-transform: translate(0,10%) scale(1,1); transform: translate(0,10%) scale(1,1); z-index: 4; opacity: 1; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover .TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover { opacity: 1; -ms-transform: translate(0,10%) scale(1,1); -webkit-transform: translate(0,10%) scale(1,1); transform: translate(0,10%) scale(1,1); z-index: 10; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(1) { opacity: 1; z-index: 9; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(2) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(3) { opacity: 1; z-index: 7; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(4) { opacity: 1; z-index: 6; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(4) { -ms-transform: translate(0,-20%) scale(0.7,0.7); -webkit-transform: translate(0,-20%) scale(0.7,0.7); transform: translate(0,-20%) scale(0.7,0.7); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(3) { -ms-transform: translate(0,-10%) scale(0.8,0.8); -webkit-transform: translate(0,-10%) scale(0.8,0.8); transform: translate(0,-10%) scale(0.8,0.8); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(2) { -ms-transform: scale(0.9,0.9); -webkit-transform: scale(0.9,0.9); transform: scale(0.9,0.9); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(1) { -ms-transform: translate(0,10%) scale(1,1); -webkit-transform: translate(0,10%) scale(1,1); transform: translate(0,10%) scale(1,1); }
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01 == 'Effect 2'){ ?>
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(5) { -ms-transform: translate(-30%,0) scale(0.6,0.6); -webkit-transform: translate(-30%,0) scale(0.6,0.6); transform: translate(-30%,0) scale(0.6,0.6); z-index: 1; opacity: 0.2; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(4) { -ms-transform: translate(-20%,0) scale(0.7,0.7); -webkit-transform: translate(-20%,0) scale(0.7,0.7); transform: translate(-20%,0) scale(0.7,0.7); z-index: 1; opacity: 0.4; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(3) { -ms-transform: translate(-10%,0) scale(0.8,0.8); -webkit-transform: translate(-10%,0) scale(0.8,0.8); transform: translate(-10%,0) scale(0.8,0.8); z-index: 2; opacity: 0.6; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(2) { -ms-transform: scale(0.9,0.9) ; -webkit-transform: scale(0.9,0.9); transform: scale(0.9,0.9); z-index: 3; opacity: 0.8; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(1) { -ms-transform: translate(10%,0) scale(1,1); -webkit-transform: translate(10%,0) scale(1,1); transform: translate(10%,0) scale(1,1); z-index: 4; opacity: 1; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover .TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover { opacity: 1; -ms-transform: translate(10%,0) scale(1,1); -webkit-transform: translate(10%,0) scale(1,1); transform: translate(10%,0) scale(1,1); z-index: 10; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(1) { opacity: 1; z-index: 9; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(2) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(3) { opacity: 1; z-index: 7; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(4) { opacity: 1; z-index: 6; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(4) { -ms-transform: translate(-20%,0) scale(0.7,0.7); -webkit-transform: translate(-20%,0) scale(0.7,0.7); transform: translate(-20%,0) scale(0.7,0.7); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(3) { -ms-transform: translate(-10%,0) scale(0.8,0.8); -webkit-transform: translate(-10%,0) scale(0.8,0.8); transform: translate(-10%,0) scale(0.8,0.8); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(2) { -ms-transform: scale(0.9,0.9); -webkit-transform: scale(0.9,0.9); transform: scale(0.9,0.9); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(1) { -ms-transform: translate(10%,0) scale(1,1); -webkit-transform: translate(10%,0) scale(1,1); transform: translate(10%,0) scale(1,1); }
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01 == 'Effect 3'){ ?>
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(8) { -ms-transform: translate(-70%,-80%) rotate(-70deg) scale(0.2,0.2); -webkit-transform: translate(-70%,-80%) rotate(-70deg) scale(0.2,0.2); transform: translate(-70%,-80%) rotate(-70deg) scale(0.2,0.2); z-index: 1; opacity: 0.3; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(7) { -ms-transform: translate(-60%,-70%) rotate(-60deg) scale(0.3,0.3); -webkit-transform: translate(-60%,-70%) rotate(-60deg) scale(0.3,0.3); transform: translate(-60%,-70%) rotate(-60deg) scale(0.3,0.3); z-index: 1; opacity: 0.4; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(6) { -ms-transform: translate(-50%,-60%) rotate(-50deg) scale(0.4,0.4); -webkit-transform: translate(-50%,-60%) rotate(-50deg) scale(0.4,0.4); transform: translate(-50%,-60%) rotate(-50deg) scale(0.4,0.4); z-index: 1; opacity: 0.5; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(5) { -ms-transform: translate(-40%,-50%) rotate(-40deg) scale(0.5,0.5); -webkit-transform: translate(-40%,-50%) rotate(-40deg) scale(0.5,0.5); transform: translate(-40%,-50%) rotate(-40deg) scale(0.5,0.5); z-index: 1; opacity: 0.6; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(4) { -ms-transform: translate(-30%,-40%) rotate(-30deg) scale(0.6,0.6); -webkit-transform: translate(-30%,-40%) rotate(-30deg) scale(0.6,0.6); transform: translate(-30%,-40%) rotate(-30deg) scale(0.6,0.6); z-index: 1; opacity: 0.7; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(3) { -ms-transform: translate(-20%,-30%) rotate(-20deg) scale(0.7,0.7); -webkit-transform: translate(-20%,-30%) rotate(-20deg) scale(0.7,0.7); transform: translate(-20%,-30%) rotate(-20deg) scale(0.7,0.7); z-index: 2; opacity: 0.8; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(2) { -ms-transform: translate(-10%,-20%) rotate(-10deg) scale(0.8,0.8); -webkit-transform: translate(-10%,-20%) rotate(-10deg) scale(0.8,0.8); transform: translate(-10%,-20%) rotate(-10deg) scale(0.8,0.8); z-index: 3; opacity: 0.9; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(1) { -ms-transform: scale(0.9,0.9); -webkit-transform: scale(0.9,0.9); transform: scale(0.9,0.9); z-index: 4; opacity: 1; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover .TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover { opacity: 1; -ms-transform: scale(1.1,1.1); -webkit-transform: scale(1.1,1.1); transform: scale(1.1,1.1); z-index: 10; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(1) { opacity: 1; z-index: 9; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(2) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(3) { opacity: 1; z-index: 7; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(4) { opacity: 1; z-index: 6; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(5) { opacity: 1; z-index: 5; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(5) { -ms-transform: translate(-40%,-50%) rotate(-40deg) scale(0.7,0.7); -webkit-transform: translate(-40%,-50%) rotate(-40deg) scale(0.7,0.7); transform: translate(-40%,-50%) rotate(-40deg) scale(0.7,0.7); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(4) { -ms-transform: translate(-30%,-40%) rotate(-30deg) scale(0.8,0.8); -webkit-transform: translate(-30%,-40%) rotate(-30deg) scale(0.8,0.8); transform: translate(-30%,-40%) rotate(-30deg) scale(0.8,0.8); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(3) { -ms-transform: translate(-20%,-30%) rotate(-20deg) scale(0.9,0.9); -webkit-transform: translate(-20%,-30%) rotate(-20deg) scale(0.9,0.9); transform: translate(-20%,-30%) rotate(-20deg) scale(0.9,0.9); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(2) { -ms-transform: translate(-10%,-20%) rotate(-10deg); -webkit-transform: translate(-10%,-20%) rotate(-10deg); transform: translate(-10%,-20%) rotate(-10deg); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(1) { -ms-transform: scale(1.1,1.1); -webkit-transform: scale(1.1,1.1); transform: scale(1.1,1.1); }
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01 == 'Effect 4'){ ?>
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(9) { -ms-transform: translate(20%,-80%) scale(0.2,0.2) rotate(-80deg); -webkit-transform: translate(20%,-80%) scale(0.4,0.2) rotate(-80deg); transform: translate(20%,-80%) scale(0.2,0.2) rotate(-80deg); z-index: 1; opacity: 0.6; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(7) { -ms-transform: translate(30%,-60%) scale(0.4,0.4) rotate(-60deg); -webkit-transform: translate(30%,-60%) scale(0.4,0.4) rotate(-60deg); transform: translate(30%,-60%) scale(0.4,0.4) rotate(-60deg); z-index: 2; opacity: 0.7; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(5) { -ms-transform: translate(40%,-40%) scale(0.6,0.6) rotate(-40deg); -webkit-transform: translate(40%,-40%) scale(0.6,0.6) rotate(-40deg); transform: translate(40%,-40%) scale(0.6,0.6) rotate(-40deg); z-index: 3; opacity: 0.8; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(3) { -ms-transform: translate(50%,-20%) scale(0.8,0.8) rotate(-20deg); -webkit-transform: translate(50%,-20%) scale(0.8,0.8) rotate(-20deg); transform: translate(50%,-20%) scale(0.8,0.8) rotate(-20deg); z-index: 4; opacity: 0.9; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(1) { -ms-transform: translate(0,20%) scale(1.1,1.1); -webkit-transform: translate(0,20%) scale(1.1,1.1); transform: translate(0,20%) scale(1.1,1.1); z-index: 5; opacity: 1; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(2) { -ms-transform: translate(-50%,-20%) scale(0.8,0.8) rotate(20deg); -webkit-transform: translate(-50%,-20%) scale(0.8,0.8) rotate(20deg); transform: translate(-50%,-20%) scale(0.8,0.8) rotate(20deg); z-index: 4; opacity: 0.9; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(4) { -ms-transform: translate(-40%,-40%) scale(0.6,0.6) rotate(40deg); -webkit-transform: translate(-40%,-40%) scale(0.6,0.6) rotate(40deg); transform: translate(-40%,-40%) scale(0.6,0.6) rotate(40deg); z-index: 3; opacity: 0.8; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(8) { -ms-transform: translate(-20%,-80%) scale(0.2,0.2) rotate(80deg); -webkit-transform: translate(-20%,-80%) scale(0.4,0.2) rotate(80deg); transform: translate(-20%,-80%) scale(0.2,0.2) rotate(80deg); z-index: 1; opacity: 0.6; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(6) { -ms-transform: translate(-30%,-60%) scale(0.4,0.4) rotate(60deg); -webkit-transform: translate(-30%,-60%) scale(0.4,0.4) rotate(60deg); transform: translate(-30%,-60%) scale(0.4,0.4) rotate(60deg); z-index: 2; opacity: 0.7; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover .TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover { opacity: 1; -ms-transform: translate(0,20%) scale(1.1,1.1); -webkit-transform: translate(0,20%) scale(1.1,1.1); transform: translate(0,20%) scale(1.1,1.1); z-index: 10; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(1) { opacity: 1; z-index: 9; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(2) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(3) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(4) { opacity: 1; z-index: 7; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(5) { opacity: 1; z-index: 7; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(6) { opacity: 1; z-index: 6; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(7) { opacity: 1; z-index: 6; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(8) { opacity: 1; z-index: 5; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(9) { opacity: 1; z-index: 5; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(9) { -ms-transform: translate(20%,-80%) scale(0.2,0.2) rotate(-80deg); -webkit-transform: translate(20%,-80%) scale(0.4,0.2) rotate(-80deg); transform: translate(20%,-80%) scale(0.2,0.2) rotate(-80deg); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(8) { -ms-transform: translate(-20%,-80%) scale(0.2,0.2) rotate(80deg); -webkit-transform: translate(-20%,-80%) scale(0.4,0.2) rotate(80deg); transform: translate(-20%,-80%) scale(0.2,0.2) rotate(80deg); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(7) { -ms-transform: translate(30%,-60%) scale(0.4,0.4) rotate(-60deg); -webkit-transform: translate(30%,-60%) scale(0.4,0.4) rotate(-60deg); transform: translate(30%,-60%) scale(0.4,0.4) rotate(-60deg); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(6) { -ms-transform: translate(-30%,-60%) scale(0.4,0.4) rotate(60deg); -webkit-transform: translate(-30%,-60%) scale(0.4,0.4) rotate(60deg); transform: translate(-30%,-60%) scale(0.4,0.4) rotate(60deg); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(5) { -ms-transform: translate(40%,-40%) scale(0.6,0.6) rotate(-40deg); -webkit-transform: translate(40%,-40%) scale(0.6,0.6) rotate(-40deg); transform: translate(40%,-40%) scale(0.6,0.6) rotate(-40deg); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(4) { -ms-transform: translate(-40%,-40%) scale(0.6,0.6) rotate(40deg); -webkit-transform: translate(-40%,-40%) scale(0.6,0.6) rotate(40deg); transform: translate(-40%,-40%) scale(0.6,0.6) rotate(40deg); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(3) { -ms-transform: translate(50%,-20%) scale(0.8,0.8) rotate(-20deg); -webkit-transform: translate(50%,-20%) scale(0.8,0.8) rotate(-20deg); transform: translate(50%,-20%) scale(0.8,0.8) rotate(-20deg); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(2) { -ms-transform: translate(-50%,-20%) scale(0.8,0.8) rotate(20deg); -webkit-transform: translate(-50%,-20%) scale(0.8,0.8) rotate(20deg); transform: translate(-50%,-20%) scale(0.8,0.8) rotate(20deg); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(1) { -ms-transform: translate(0,20%) scale(1.1,1.1); -webkit-transform: translate(0,20%) scale(1.1,1.1); transform: translate(0,20%) scale(1.1,1.1); }
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01 == 'Effect 5'){ ?>
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(8) { -ms-transform: translate(45%,60%) scale(0.1,0.1); -webkit-transform: translate(45%,60%) scale(0.1,0.1); transform: translate(45%,60%) scale(0.1,0.1); z-index: 1; opacity: 1; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(7) { -ms-transform: translate(30%,60%) scale(0.1,0.1); -webkit-transform: translate(30%,60%) scale(0.1,0.1); transform: translate(30%,60%) scale(0.1,0.1); z-index: 1; opacity: 1; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(6) { -ms-transform: translate(15%,60%) scale(0.1,0.1); -webkit-transform: translate(15%,60%) scale(0.1,0.1); transform: translate(15%,60%) scale(0.1,0.1); z-index: 1; opacity: 1; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(5) { -ms-transform: translate(0,60%) scale(0.1,0.1); -webkit-transform: translate(0,60%) scale(0.1,0.1); transform: translate(0,60%) scale(0.1,0.1); z-index: 1; opacity: 1; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(4) { -ms-transform: translate(-15%,60%) scale(0.1,0.1); -webkit-transform: translate(-15%,60%) scale(0.1,0.1); transform: translate(-15%,60%) scale(0.1,0.1); z-index: 1; opacity: 1; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(3) { -ms-transform: translate(-30%,60%) scale(0.1,0.1); -webkit-transform: translate(-30%,60%) scale(0.1,0.1); transform: translate(-30%,60%) scale(0.1,0.1); z-index: 1; opacity: 1; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(2) { -ms-transform: translate(-45%,60%) scale(0.1,0.1); -webkit-transform: translate(-45%,60%) scale(0.1,0.1); transform: translate(-45%,60%) scale(0.1,0.1); z-index: 1; opacity: 1; }
						#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:nth-child(1) { -ms-transform: translate(0,0) scale(1,1); -webkit-transform: translate(0,0) scale(1,1); transform: translate(0,0) scale(1,1); z-index: 1; opacity: 1; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover .TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover { opacity: 1; -ms-transform: translate(0,0) scale(1,1); -webkit-transform: translate(0,0) scale(1,1); transform: translate(0,0) scale(1,1); z-index: 10; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(1) { opacity: 1; z-index: 9; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(2) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(3) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(4) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(5) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(6) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(7) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(8) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image img:nth-child(9) { opacity: 1; z-index: 8; }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(1) { -ms-transform: translate(45%,60%) scale(0.1,0.1); -webkit-transform: translate(45%,60%) scale(0.1,0.1); transform: translate(45%,60%) scale(0.1,0.1); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(2) { -ms-transform: translate(30%,60%) scale(0.1,0.1); -webkit-transform: translate(30%,60%) scale(0.1,0.1); transform: translate(30%,60%) scale(0.1,0.1); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(3) { -ms-transform: translate(15%,60%) scale(0.1,0.1); -webkit-transform: translate(15%,60%) scale(0.1,0.1); transform: translate(15%,60%) scale(0.1,0.1); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(4) { -ms-transform: translate(0,60%) scale(0.1,0.1); -webkit-transform: translate(0,60%) scale(0.1,0.1); transform: translate(0,60%) scale(0.1,0.1); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(5) { -ms-transform: translate(-15%,60%) scale(0.1,0.1); -webkit-transform: translate(-15%,60%) scale(0.1,0.1); transform: translate(-15%,60%) scale(0.1,0.1); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(6) { -ms-transform: translate(-30%,60%) scale(0.1,0.1); -webkit-transform: translate(-30%,60%) scale(0.1,0.1); transform: translate(-30%,60%) scale(0.1,0.1); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(7) { -ms-transform: translate(-45%,60%) scale(0.1,0.1); -webkit-transform: translate(-45%,60%) scale(0.1,0.1); transform: translate(-45%,60%) scale(0.1,0.1); }
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image:hover img:nth-child(8) { -ms-transform: translate(0,0) scale(1,1); -webkit-transform: translate(0,0) scale(1,1); transform: translate(0,0) scale(1,1); }
					<?php }?>
					@media screen and (max-width: 820px)
					{
						.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-text, .TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image { width: 100%; }
					}
				</style>
				<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01 == 'Effect 5'){ ?>
					<script type="text/javascript">
						jQuery(window).load(function () {
							jQuery('#TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-selection-button').click(function() {
								event.stopPropagation();
								jQuery('#TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-selection-button-dropdown').fadeToggle(250);
							});
							jQuery('html').click(function() { jQuery('#TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-selection-button-dropdown').fadeOut(250); });
							jQuery('.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image').each(function() {
								var this_element = jQuery(this);
								this_element.height(this_element.find('img:first-child').height());
								this_element.find('.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover').height(this_element.find('img:first-child').height());
								var imgBackground = this_element.find('img:first-child').attr('src'); 
								jQuery(this).css({ "background-size":"100% 100%", "background-repeat":"no-repeat", "background-image":"url('"+imgBackground+"')" });
							});
							function resize_popup()
							{
								var window_width = window.innerWidth;
								var window_height = window.innerHeight;
								var max_image_width = window.innerWidth - ((35*2)+(window_width/100*40));
								var max_image_height = window.innerHeight - 200;
								var image_width = jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').width();
								var image_height = jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').height();
								var image_WH_ratio = image_width/image_height;
								var image_HW_ratio = image_height/image_width;
								var image_new_width = max_image_height*image_WH_ratio;
								var image_new_height = max_image_width*image_HW_ratio;
								jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').width(max_image_width);
								jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').height(max_image_height);
								if(max_image_width > 2 && max_image_height > 2)
								{
									if(image_new_height>max_image_height)
									{
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').width(image_new_width);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').height(max_image_height);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').css('margin-top',-max_image_height/2);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').css('margin-left',-image_new_width/2);
									}
									else
									{
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').width(max_image_width);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').height(image_new_height);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').css('margin-top',-image_new_height/2);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').css('margin-left',-max_image_width/2);
									}
								}
							}
							function open_close_gallery()
							{
								var this_element = '';
								jQuery('.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover').click(function() {
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').find('img').remove();
									this_element = jQuery(this);
									this_element.parent().find('img').clone().appendTo('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image');
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>').show();
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>').removeClass('fadeOut').addClass('fadeIn');
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').removeClass('fadeOutDown').addClass('fadeInDown');
									resize_popup();
								});
								jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-close').click(function() {
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>').removeClass('fadeIn').addClass('fadeOut').delay(500).hide(0);
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').removeClass('fadeInDown').addClass('fadeOutDown');
								});
							}
							function next_slide()
							{
								jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:first-child').insertAfter( jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:last-child') );
							}
							function previous_slide()
							{
								jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:last-child').insertBefore( jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:first-child') );
							}
							jQuery(document).keydown(function(e) {
								switch(e.which) {
									case 37: // left
										previous_slide();
										break;
									case 38: // up
										next_slide();
										break;
									case 39: // right
										next_slide();
										break;
									case 40: // down
										previous_slide();
										break;
									case 27: // Esc
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>').removeClass('fadeIn').addClass('fadeOut').delay(500).hide(0);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').removeClass('fadeInDown').addClass('fadeOutDown');
										break;
									default: return; // exit this handler for other keys
								}
								e.preventDefault(); // prevent the default action (scroll / move caret)
							});
							resize_popup();
							jQuery( window ).resize(function() { resize_popup(); });
							open_close_gallery();
							jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-right').click(function() { next_slide(); });
							jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-left').click(function() { previous_slide(); });
						});
					</script>
				<?php } else { ?>
					<script type="text/javascript">
						jQuery(window).load(function () {
							jQuery('#TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-selection-button').click(function() {
								event.stopPropagation();
								jQuery('#TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-selection-button-dropdown').fadeToggle(250);
							});
							jQuery('html').click(function() { jQuery('#TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-selection-button-dropdown').fadeOut(250); });
							jQuery('.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image').each(function() {
								var this_element = jQuery(this);
								this_element.height(this_element.find('img:first-child').height());
								this_element.find('.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover').height(this_element.find('img:first-child').height());
							});
							function resize_popup()
							{
								var window_width = window.innerWidth;
								var window_height = window.innerHeight;
								var max_image_width = window.innerWidth - ((35*2)+(window_width/100*40));
								var max_image_height = window.innerHeight - 200;
								var image_width = jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').width();
								var image_height = jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').height();
								var image_WH_ratio = image_width/image_height;
								var image_HW_ratio = image_height/image_width;
								var image_new_width = max_image_height*image_WH_ratio;
								var image_new_height = max_image_width*image_HW_ratio;
								jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').width(max_image_width);
								jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').height(max_image_height);
								if(max_image_width > 2 && max_image_height > 2)
								{
									if(image_new_height>max_image_height)
									{
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').width(image_new_width);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').height(max_image_height);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').css('margin-top',-max_image_height/2);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').css('margin-left',-image_new_width/2);
									}
									else
									{
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').width(max_image_width);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').height(image_new_height);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').css('margin-top',-image_new_height/2);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img').css('margin-left',-max_image_width/2);
									}
								}
							}
							function open_close_gallery()
							{
								var this_element = '';
								jQuery('.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover').click(function() {
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').find('img').remove();
									this_element = jQuery(this);
									this_element.parent().find('img').clone().appendTo('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image');
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>').show();
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>').removeClass('fadeOut').addClass('fadeIn');
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').removeClass('fadeOutDown').addClass('fadeInDown');
									resize_popup();
								});
								jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-close').click(function() {
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>').removeClass('fadeIn').addClass('fadeOut').delay(500).hide(0);
									jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').removeClass('fadeInDown').addClass('fadeOutDown');
								});
							}
							function next_slide()
							{
								jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:last-child').insertBefore( jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:first-child') );
							}
							function previous_slide()
							{
								jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:first-child').insertAfter( jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image img:last-child') );
							}
							jQuery(document).keydown(function(e) {
								switch(e.which) {
									case 37: // left
										previous_slide();
										break;
									case 38: // up
										next_slide();
										break;
									case 39: // right
										next_slide();
										break;
									case 40: // down
										previous_slide();
										break;
									case 27: // Esc
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>').removeClass('fadeIn').addClass('fadeOut').delay(500).hide(0);
										jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image').removeClass('fadeInDown').addClass('fadeOutDown');
										break;
									default: return; // exit this handler for other keys
								}
								e.preventDefault(); // prevent the default action (scroll / move caret)
							});
							resize_popup();
							jQuery( window ).resize(function() { resize_popup(); });
							open_close_gallery();
							jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-right').click(function() { next_slide(); });
							jQuery('#TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-left').click(function() { previous_slide(); });
						});
					</script>
				<?php }?>
				<div id="TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>">
					<div id="TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner">
						<div id="TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-left" class="TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-button1">
							<span class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>-left"></span>
						</div>
						<div id="TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-right" class="TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-button1">
							<span class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>-right"></span>
						</div>
						<div id="TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-close" class="TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-inner-button2">
							<span class="totalsoft totalsoft-close"></span>
						</div>
						<div id="TS_Portfolio_GAA_fullscreen<?php echo $Total_Soft_Portfolio;?>-image"></div>
					</div>
				</div>
				<div id="TS_Portfolio_GAA<?php echo $Total_Soft_Portfolio;?>">
					<div id="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>">
						<?php for($i=0;$i<$TotalSoftPortfolioManager[0]->TotalSoftPortfolio_AlbumCount;$i++){
							$TSoftPort_ContPop_Images=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE TotalSoftPortfolio_IA = %s and Portfolio_ID = %s order by id", $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle, $Total_Soft_Portfolio));
							?>
							<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content">
								<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content_titlea">
									<?php echo html_entity_decode($TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle);?>
								</div>
								<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02 == 'Position 1') { ?>
									<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'true') { ?>
										<?php if($i % 2 != 0){ ?>
											<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-text" style="margin-right:1%;">
												<?php echo html_entity_decode($TSoftPort_ContPop_Images[0]->TotalSoftPortfolio_IDesc);?>
											</div>
										<?php } ?>
										<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image">
											<?php for($j=0;$j<count($TSoftPort_ContPop_Images);$j++){ ?>
												<img src="<?php echo $TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IURL;?>"/>
											<?php } ?>
											<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover">
												<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover-cercle">
													<span class="TS_Portfolio_GAA_IFOP<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-search"></span>
												</div>
											</div>
										</div>
										<?php if($i % 2 == 0){ ?>
											<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-text" style="margin-left:1%;">
												<?php echo html_entity_decode($TSoftPort_ContPop_Images[0]->TotalSoftPortfolio_IDesc);?>
											</div>
										<?php } ?>
									<?php } else { ?>
										<?php if($i % 2 == 0){ ?>
											<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-text" style="margin-right:1%;">
												<?php echo html_entity_decode($TSoftPort_ContPop_Images[0]->TotalSoftPortfolio_IDesc);?>
											</div>
										<?php } ?>
										<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image">
											<?php for($j=0;$j<count($TSoftPort_ContPop_Images);$j++){ ?>
												<img src="<?php echo $TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IURL;?>"/>
											<?php } ?>
											<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover">
												<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover-cercle">
													<span class="TS_Portfolio_GAA_IFOP<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-search"></span>
												</div>
											</div>
										</div>
										<?php if($i % 2 != 0){ ?>
											<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-text" style="margin-left:1%;">
												<?php echo html_entity_decode($TSoftPort_ContPop_Images[0]->TotalSoftPortfolio_IDesc);?>
											</div>
										<?php } ?>
									<?php }?>
								<?php } else { ?>
									<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'true') { ?>
										<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-text">
											<?php echo html_entity_decode($TSoftPort_ContPop_Images[0]->TotalSoftPortfolio_IDesc);?>
										</div>
										<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image">
											<?php for($j=0;$j<count($TSoftPort_ContPop_Images);$j++){ ?>
												<img src="<?php echo $TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IURL;?>"/>
											<?php } ?>
											<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover">
												<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover-cercle">
													<span class="TS_Portfolio_GAA_IFOP<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-search"></span>
												</div>
											</div>
										</div>
									<?php } else { ?>
										<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image">
											<?php for($j=0;$j<count($TSoftPort_ContPop_Images);$j++){ ?>
												<img src="<?php echo $TSoftPort_ContPop_Images[$j]->TotalSoftPortfolio_IURL;?>"/>
											<?php } ?>
											<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover">
												<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover-cercle">
													<span class="TS_Portfolio_GAA_IFOP<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-search"></span>
												</div>
											</div>
										</div>
										<div class="TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-text">
											<?php echo html_entity_decode($TSoftPort_ContPop_Images[0]->TotalSoftPortfolio_IDesc);?>
										</div>
									<?php }?>
								<?php }?>
							</div>
						<?php } ?>
					</div>
				</div>
				<input type="text" style="display: none;" class="TotalSoft_Port_GAA_05" value="<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05;?>">
				<input type="text" style="display: none;" class="TotalSoft_Port_GAA_06" value="<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>">
				<script type="text/javascript">
					jQuery(document).ready(function(){
						var TotalSoft_Port_GAA_05=parseInt(jQuery(".TotalSoft_Port_GAA_05").val());
						var TotalSoft_Port_GAA_06=parseInt(jQuery(".TotalSoft_Port_GAA_06").val());
						function resp(){
							jQuery(".TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image,.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover").css("min-height",jQuery(".TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image").width()*TotalSoft_Port_GAA_06/TotalSoft_Port_GAA_05);
							jQuery(".TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image,.TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image-hover").css("max-height",jQuery(".TS_Portfolio_GAA_inner<?php echo $Total_Soft_Portfolio;?>-content-image").width()*TotalSoft_Port_GAA_06/TotalSoft_Port_GAA_05);
						}
						resp();
						jQuery(window).resize(function(){ resp(); })
					})
				</script>
			<?php } else if($TotalSoftPortfolioOpt[0]->TotalSoftPortfolio_SetType == 'Portfolio / Hover Effects'){ ?>
				<script src="<?php echo plugins_url('../JS/Isotope.min.js',__FILE__);?>" type="text/javascript"></script>
				<style type="text/css">
					.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
					{
						margin: 20px 0;
						text-align: center;
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>;
						position: relative;
						z-index: 0;
					}
					.filters-button-group_<?php echo $Total_Soft_Portfolio;?> div
					{
						position: absolute;
						width: 100%;
						height: 100%;
						top: 0;
						left: 0;
						z-index: 1;
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04;?>;
					}
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow01') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> 
						{
							box-shadow: 0 10px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 0 10px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 10px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow02') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?>:after
						{
							bottom: 15px;
							left: 10px;
							width: 50%;
							height: 20%;
							max-width: 300px;
							max-height: 100px;
							-webkit-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-transform: rotate(-3deg);
							-moz-transform: rotate(-3deg);
							-ms-transform: rotate(-3deg);
							-o-transform: rotate(-3deg);
							transform: rotate(-3deg);
							z-index: -1;
							position: absolute;
							content: "";
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>:after
						{
							transform: rotate(3deg);
							-moz-transform: rotate(3deg);
							-webkit-transform: rotate(3deg);
							right: 10px;
							left: auto;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow03') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>:before
						{
							bottom: 15px;
							left: 10px;
							width: 50%;
							height: 20%;
							max-width: 300px;
							max-height: 100px;
							-webkit-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-transform: rotate(-3deg);
							-moz-transform: rotate(-3deg);
							-ms-transform: rotate(-3deg);
							-o-transform: rotate(-3deg);
							transform: rotate(-3deg);
							z-index: -1;
							position: absolute;
							content: "";
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow04') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>:after
						{
							bottom: 15px;
							right: 10px;
							width: 50%;
							height: 20%;
							max-width: 300px;
							max-height: 100px;
							-webkit-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-transform: rotate(3deg);
							-moz-transform: rotate(3deg);
							-ms-transform: rotate(3deg);
							-o-transform: rotate(3deg);
							transform: rotate(3deg);
							z-index: -1;
							position: absolute;
							content: "";
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow05') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?>:after
						{
							top: 15px;
							left: 10px;
							width: 50%;
							height: 20%;
							max-width: 300px;
							max-height: 100px;
							z-index: -1;
							position: absolute;
							content: "";
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							box-shadow: 0 -15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 0 -15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 -15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							transform: rotate(3deg);
							-moz-transform: rotate(3deg);
							-webkit-transform: rotate(3deg);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>:after
						{
							transform: rotate(-3deg);
							-moz-transform: rotate(-3deg);
							-webkit-transform: rotate(-3deg);
							right: 10px;
							left: auto;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow06') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
						{
							position:relative;
							box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-webkit-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-moz-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?>:after
						{
							content:"";
							position:absolute;
							z-index:-1;
							box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							top:50%;
							bottom:0;
							left:10px;
							right:10px;
							border-radius:100px / 10px;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow07') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
						{
							position:relative;
							box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-webkit-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-moz-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?>:after
						{
							content:"";
							position:absolute;
							z-index:-1;
							box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							top:0;
							bottom:0;
							left:10px;
							right:10px;
							border-radius:100px / 10px;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>:after
						{
							right:10px; 
							left:auto; 
							transform:skew(8deg) rotate(3deg);
							-moz-transform:skew(8deg) rotate(3deg);
							-webkit-transform:skew(8deg) rotate(3deg);
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow08') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
						{
							position:relative;
							box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-webkit-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-moz-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?>:after
						{
							content:"";
							position:absolute;
							z-index:-1;
							box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							top:10px;
							bottom:10px;
							left:0;
							right:0;
							border-radius:100px / 10px;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>:after
						{
							right:10px;
							left:auto;
							transform:skew(8deg) rotate(3deg);
							-moz-transform:skew(8deg) rotate(3deg);
							-webkit-transform:skew(8deg) rotate(3deg);
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow09') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 0 0 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 0 0 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 0 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow10') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 4px -4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 4px -4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 4px -4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow11') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 5px 5px 3px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 5px 5px 3px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 5px 5px 3px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow12') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 2px 2px white, 4px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 2px 2px white, 4px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 2px 2px white, 4px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow13') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 8px 8px 18px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 8px 8px 18px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 8px 8px 18px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow14') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 0 8px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 8px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 0 8px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow15') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 0 0 18px 7px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 0 18px 7px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 0 0 18px 7px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'none') { ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: none !important;
							-moz-box-shadow: none !important;
							-webkit-box-shadow: none !important;
						}
					<?php } ?>
					.TSPortfolioHE_Button_<?php echo $Total_Soft_Portfolio;?>
					{
						display: inline-block;
						padding: 5px 10px;
						background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05;?>;
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>;
						font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>;
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?>px;
						cursor: pointer;
						margin: 10px;
						position: relative !important;
						z-index: 2;
						text-transform: none !important;
						border: none !important;
						height: inherit;
						line-height: 1 !important;
						overflow: visible !important;
					}
					.TSPortfolioHE_Button_<?php echo $Total_Soft_Portfolio;?> span
					{
						font-weight: 400 !important;
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?> !important;
						font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?> !important;
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?>px !important;
						padding: 0 !important;
						line-height: 1 !important;
					}
					.TSPortfolioHE_Button_<?php echo $Total_Soft_Portfolio;?>:active
					{
						padding: 5px 10px !important;
						border: none !important;
					}
					.TSPortfolioHE_Button_<?php echo $Total_Soft_Portfolio;?>:active, .TSPortfolioHE_Button_<?php echo $Total_Soft_Portfolio;?>:hover, .TSPortfolioHE_Button_<?php echo $Total_Soft_Portfolio;?>:focus
					{
						background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05;?> !important;
						outline: none !important;
						opacity: 1 !important;
					}
					.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover .TSPortfolioHE_Button_Span_<?php echo $Total_Soft_Portfolio;?>, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked .TSPortfolioHE_Button_Span_<?php echo $Total_Soft_Portfolio;?>
					{
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
					}
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect01'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:before,
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after
						{
							content: "" !important;
							width: 2px;
							height: 100%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							position: absolute;
							top: 0;
							transition: all 0.3s ease 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:before{ left: 0; }
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after{ right: 0; }
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:after
						{
							width: 100%;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect02'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:before
						{
							content: "" !important;
							width: 100%;
							height: 2px;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							position: absolute;
							top: 0;
							left: 0;
							transition: all 0.3s ease 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:before
						{
							height: 100%;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect03'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after
						{
							content: '(' !important;
							position: absolute;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07 + 5;?>px;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							top: 0px;
							left: 0;
							opacity: 0;
							transform: translateX(10px);
							transition: all 0.3s ease 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after
						{
							content: ')' !important;
							left: auto;
							right: 0;
							transform: translateX(-10px);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:after
						{
							opacity: 1;
							transform: translateX(0px);
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect04'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after
						{
							content: "";
							width: 50px;
							height: 50px;
							border-radius: 50%;
							border: 4px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							position: absolute;
							top: 50%;
							left: 50%;
							opacity: 0;
							transform: translateX(-50%) translateY(-50%) scale(0.8);
							-webkit-transform: translateX(-50%) translateY(-50%) scale(0.8);
							-ms-transform: translateX(-50%) translateY(-50%) scale(0.8);
							transition: all 0.3s ease 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after
						{
							border-width: 2px;
							transition: all 0.4s ease 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:before
						{
							opacity: 1;
							transform: translateX(-50%) translateY(-50%) scale(1);
							-webkit-transform: translateX(-50%) translateY(-50%) scale(1);
							-ms-transform: translateX(-50%) translateY(-50%) scale(1);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:after
						{
							opacity: 1;
							transform: translateX(-50%) translateY(-50%) scale(1.3);
							-webkit-transform: translateX(-50%) translateY(-50%) scale(1.3);
							-ms-transform: translateX(-50%) translateY(-50%) scale(1.3);
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect05'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after
						{
							content: "";
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							position: absolute;
							top: 0;
							left: 0;
							opacity: 1;
							transition: all 0.3s ease 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:before
						{
							width: 2px;
							height: 0;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after
						{
							width: 100%;
							height: 2px;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:before
						{
							height: 100%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:after
						{
							opacity: 0;
							top: 100%;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect06'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after
						{
							content: "";
							width: 2px;
							height: 100%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							opacity: 0.5;
							position: absolute;
							transition: all 0.3s ease 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:before { left: 0; top: 0; }
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after { right: 0; bottom: 0; }
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:after
						{
							width: 100%;
							height: 2px;
							opacity: 1;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect07'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after
						{
							content: "";
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							position: absolute;
							bottom: 0;
							left: 0;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:before
						{
							width: 0;
							height: 1px;
							transition: all 0.3s ease 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:before
						{
							width: 100%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after
						{
							width: 100%;
							height: 0;
							transition: all 0.5s ease 0.3s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:after
						{
							height: 100%;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect08'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:after
						{
							content: "";
							width: 0;
							height: 3px;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							position: absolute;
							bottom: 0;
							left: 0;
							transition: all 0.5s ease 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover:after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked:after
						{
							width: 100%;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect09'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							content: '';
							position: absolute;
							left: 0;
							width: 100%;
							height: 2px;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transform: scale3d(0, 1, 1);
							transform: scale3d(0, 1, 1);
							-webkit-transition: -webkit-transform 0.2s;
							transition: transform 0.2s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							top: 0;
							-webkit-transform-origin: 0 50%;
							transform-origin: 0 50%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							bottom: 0;
							-webkit-transform-origin: 100% 50%;
							transform-origin: 100% 50%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::after
						{
							-webkit-transform: scale3d(1, 1, 1);
							transform: scale3d(1, 1, 1);
							-webkit-transition-timing-function: cubic-bezier(0.22, 0.61, 0.36, 1);
							transition-timing-function: cubic-bezier(0.22, 0.61, 0.36, 1);
							-webkit-transition-duration: 0.4s;
							transition-duration: 0.4s;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect10'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							content: '';
							position: absolute;
							bottom: 0;
							left: 0;
							width: 100%;
							height: 3px;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transform: scale3d(0, 1, 1);
							transform: scale3d(0, 1, 1);
							-webkit-transition: -webkit-transform 0.1s;
							transition: transform 0.1s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before
						{
							-webkit-transform: scale3d(1, 1, 1);
							transform: scale3d(1, 1, 1);
							-webkit-transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
							transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
							-webkit-transition-duration: 0.3s;
							transition-duration: 0.3s;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect11'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							content: '';
							position: absolute;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transition: -webkit-transform 0.2s;
							transition: transform 0.2s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after
						{
							top: 0;
							width: 2px;
							height: 100%;
							-webkit-transform: scale3d(1, 0, 1);
							transform: scale3d(1, 0, 1);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before
						{
							left: 0;
							-webkit-transform-origin: 50% 100%;
							transform-origin: 50% 100%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after
						{
							right: 0;
							-webkit-transform-origin: 50% 0%;
							transform-origin: 50% 0%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							left: 0;
							width: 100%;
							height: 2px;
							-webkit-transform: scale3d(0, 1, 1);
							transform: scale3d(0, 1, 1);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							top: 0;
							-webkit-transform-origin: 0 50%;
							transform-origin: 0 50%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							bottom: 0;
							-webkit-transform-origin: 100% 50%;
							transform-origin: 100% 50%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::after
						{
							-webkit-transform: scale3d(1, 1, 1);
							transform: scale3d(1, 1, 1);
							-webkit-transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
							transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
							-webkit-transition-duration: 0.4s;
							transition-duration: 0.4s;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect12'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							content: '';
							position: absolute;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transition: -webkit-transform 0.3s;
							transition: transform 0.3s;
							-webkit-transition-timing-function: cubic-bezier(0.44, 0.05, 0.55, 0.95);
							transition-timing-function: cubic-bezier(0.44, 0.05, 0.55, 0.95);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after
						{
							top: 0;
							width: 3px;
							height: 100%;
							-webkit-transform: scale3d(0.1, 0, 1);
							transform: scale3d(0.1, 0, 1);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before { left: 0; }
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after { right: 0; }
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							left: 0;
							width: 100%;
							height: 3px;
							-webkit-transform: scale3d(0, 0.1, 1);
							transform: scale3d(0, 0.1, 1);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before { top: 0; }
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after { bottom: 0; }
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::after
						{
							-webkit-transform: scale3d(1, 1, 1);
							transform: scale3d(1, 1, 1);
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect13'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							content: '';
							position: absolute;
							bottom: 0;
							left: 0;
							width: 100%;
							height: 2px;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transform: scale3d(0, 5, 1);
							transform: scale3d(0, 5, 1);
							-webkit-transform-origin: 0% 50%;
							transform-origin: 0% 50%;
							-webkit-transition: -webkit-transform 0.3s;
							transition: transform 0.3s;
							-webkit-transition-timing-function: cubic-bezier(1, 0.68, 0.16, 0.9);
							transition-timing-function: cubic-bezier(1, 0.68, 0.16, 0.9);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before
						{
							-webkit-transform: scale3d(1, 1, 1);
							transform: scale3d(1, 1, 1);
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect14'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button { position: relative; overflow: hidden; }
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							content: '';
							position: absolute;
							bottom: 0;
							left: 0;
							width: 100%;
							height: 2px;
							opacity: 0;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transform: translate3d(0, -3em, 0);
							transform: translate3d(0, -3em, 0);
							-webkit-transition: -webkit-transform 0s 0.3s, opacity 0.2s;
							transition: transform 0s 0.3s, opacity 0.2s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before
						{
							opacity: 1;
							-webkit-transform: translate3d(0, 0, 0);
							transform: translate3d(0, 0, 0);
							-webkit-transition: -webkit-transform 0.3s, opacity 0.1s;
							transition: transform 0.3s, opacity 0.1s;
							-webkit-transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
							transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span { display: block; pointer-events: none; }
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span
						{
							-webkit-animation: anim-francisco 0.3s forwards;
							animation: anim-francisco 0.3s forwards;
						}
						@-webkit-keyframes anim-francisco
						{
							50% { opacity: 0; -webkit-transform: translate3d(0, 100%, 0); transform: translate3d(0, 100%, 0); }
							51% { opacity: 0; -webkit-transform: translate3d(0, -100%, 0); transform: translate3d(0, -100%, 0); }
							100% { opacity: 1; -webkit-transform: translate3d(0, 0, 0); transform: translate3d(0, 0, 0); }
						}
						@keyframes anim-francisco
						{
							50% { opacity: 0; -webkit-transform: translate3d(0, 100%, 0); transform: translate3d(0, 100%, 0); }
							51% { opacity: 0; -webkit-transform: translate3d(0, -100%, 0); transform: translate3d(0, -100%, 0); }
							100% { opacity: 1; -webkit-transform: translate3d(0, 0, 0); transform: translate3d(0, 0, 0); }
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect15'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							content: '';
							position: absolute;
							bottom: 0;
							left: 0;
							width: 100%;
							height: 4px;
							opacity: 0;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transform: scale3d(0, 1, 1);
							transform: scale3d(0, 1, 1);
							-webkit-transform-origin: 100% 50%;
							transform-origin: 100% 50%;
							-webkit-transition: -webkit-transform 0s 0.2s, opacity 0.2s;
							transition: transform 0s 0.2s, opacity 0.2s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before
						{
							opacity: 1;
							-webkit-transform: scale3d(1, 1, 1);
							transform: scale3d(1, 1, 1);
							-webkit-transition: -webkit-transform 0.2s, opacity 0.1s;
							transition: transform 0.2s, opacity 0.1s;
							-webkit-transition-delay: 0.35s;
							transition-delay: 0.35s;
							-webkit-transition-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
							transition-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span { display: block; pointer-events: none; }
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span
						{
							-webkit-animation: anim-trinculo 0.6s forwards;
							animation: anim-trinculo 0.6s forwards;
						}
						@-webkit-keyframes anim-trinculo
						{
							50% { opacity: 0; -webkit-transform: translate3d(100%, 0, 0); transform: translate3d(100%, 0, 0); }
							51% { opacity: 0; -webkit-transform: translate3d(-100%, 0, 0); transform: translate3d(-100%, 0, 0); }
							75% { opacity: 1; -webkit-transform: translate3d(5px, 0, 0); transform: translate3d(5px, 0, 0); }
							100% { opacity: 1; -webkit-transform: translate3d(0, 0, 0); transform: translate3d(0, 0, 0); }
						}
						@keyframes anim-trinculo
						{
							50% { opacity: 0; -webkit-transform: translate3d(100%, 0, 0); transform: translate3d(100%, 0, 0); }
							51% { opacity: 0; -webkit-transform: translate3d(-100%, 0, 0); transform: translate3d(-100%, 0, 0); }
							75% { opacity: 1; -webkit-transform: translate3d(5px, 0, 0); transform: translate3d(5px, 0, 0); }
							100% { opacity: 1; -webkit-transform: translate3d(0, 0, 0); transform: translate3d(0, 0, 0); }
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect16'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							content: '';
							position: absolute;
							bottom: 0;
							width: 10px;
							height: 2px;
							opacity: 0;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							-webkit-transform: translate3d(0, 10px, 0);
							transform: translate3d(0, 10px, 0);
							-webkit-transition: -webkit-transform 0.3s, opacity 0.3s;
							transition: transform 0.3s, opacity 0.3s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::after
						{
							opacity: 1;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							left: 0;
							-webkit-transform-origin: 0% 0%;
							transform-origin: 0% 0%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before
						{
							-webkit-transform: rotate3d(0, 0, 1, -90deg);
							transform: rotate3d(0, 0, 1, -90deg);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							right: 0;
							-webkit-transform-origin: 100% 0%;
							transform-origin: 100% 0%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::after
						{
							-webkit-transform: rotate3d(0, 0, 1, 90deg);
							transform: rotate3d(0, 0, 1, 90deg);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before
						{
							left: 0;
							width: 100%;
							-webkit-transform: translate3d(0, 10px, 0);
							transform: translate3d(0, 10px, 0);
							-webkit-transition: -webkit-transform 0.3s, opacity 0.3s;
							transition: transform 0.3s, opacity 0.3s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span::before
						{
							opacity: 1;
							-webkit-transform: translate3d(0, 0, 0);
							transform: translate3d(0, 0, 0);
							-webkit-transition: -webkit-transform 0.3s, opacity 0.1s;
							transition: transform 0.3s, opacity 0.1s;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect17'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							content: '';
							position: absolute;
							width: 10px;
							height: 10px;
							opacity: 0;
							border: 2px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transition: -webkit-transform 0.3s, opacity 0.3s;
							transition: transform 0.3s, opacity 0.3s;
							-webkit-transition-timing-function: cubic-bezier(0.17, 0.67, 0.05, 1.29);
							transition-timing-function: cubic-bezier(0.17, 0.67, 0.05, 1.29);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							top: 0;
							left: 0;
							border-width: 2px 0 0 2px;
							-webkit-transform: translate3d(10px, 10px, 0);
							transform: translate3d(10px, 10px, 0);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							right: 0;
							bottom: 0;
							border-width: 0 2px 2px 0;
							-webkit-transform: translate3d(-10px, -10px, 0);
							transform: translate3d(-10px, -10px, 0);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::after
						{
							opacity: 1;
							-webkit-transform: translate3d(0, 0, 0);
							transform: translate3d(0, 0, 0);
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect18'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							content: '';
							position: absolute;
							pointer-events: none;
							opacity: 0;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transition: -webkit-transform 0.3s, opacity 0.3s;
							transition: transform 0.3s, opacity 0.3s;
							-webkit-transition-timing-function: cubic-bezier(0.22, 0.61, 0.36, 1);
							transition-timing-function: cubic-bezier(0.22, 0.61, 0.36, 1);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after
						{
							left: 0;
							width: 100%;
							height: 2px;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before
						{
							top: 0;
							-webkit-transform: translate3d(0, 15px, 0);
							transform: translate3d(0, 15px, 0);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after
						{
							bottom: 0;
							-webkit-transform: translate3d(0, -15px, 0);
							transform: translate3d(0, -15px, 0);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							top: 0;
							width: 2px;
							height: 100%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							left: 0;
							-webkit-transform: translate3d(15px, 0, 0);
							transform: translate3d(15px, 0, 0);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							right: 0;
							-webkit-transform: translate3d(-15px, 0, 0);
							transform: translate3d(-15px, 0, 0);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::after
						{
							opacity: 1;
							-webkit-transform: translate3d(0, 0, 0);
							transform: translate3d(0, 0, 0);
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect19'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							content: '';
							position: absolute;
							z-index: 10;
							width: 100%;
							height: 2px;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transform: scale3d(0, 1, 1);
							transform: scale3d(0, 1, 1);
							-webkit-animation-fill-mode: initial;
							animation-fill-mode: initial;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							top: 0;
							right: 0;
							-webkit-transform-origin: 100% 50%;
							transform-origin: 100% 50%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							bottom: 0;
							left: 0;
							-webkit-transform-origin: 0% 50%;
							transform-origin: 0% 50%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before
						{
							-webkit-animation: anim-cordelia-top 0.6s linear both;
							animation: anim-cordelia-top 0.6s linear both;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::after
						{
							-webkit-animation: anim-cordelia-bottom 0.6s linear both;
							animation: anim-cordelia-bottom 0.6s linear both;
						}
						@-webkit-keyframes anim-cordelia-top
						{
							0% { -webkit-transform: scale3d(0, 1, 1); transform: scale3d(0, 1, 1); }
							10% { -webkit-transform: scale3d(0.05, 1, 1); transform: scale3d(0.05, 1, 1); -webkit-animation-timing-function: ease-in; animation-timing-function: ease-in; }
							50% {
								-webkit-transform: translate3d(-95%, 0, 0) scale3d(0.05, 1, 1);
								transform: translate3d(-95%, 0, 0) scale3d(0.05, 1, 1);
								-webkit-animation-timing-function: ease-out;
								animation-timing-function: ease-out;
							}
							100% { -webkit-transform: translate3d(0, 0, 0) scale3d(1, 1, 1); transform: translate3d(0, 0, 0) scale3d(1, 1, 1); }
						}
						@keyframes anim-cordelia-top
						{
							0% { -webkit-transform: scale3d(0, 1, 1); transform: scale3d(0, 1, 1); }
							10% { -webkit-transform: scale3d(0.05, 1, 1); transform: scale3d(0.05, 1, 1); -webkit-animation-timing-function: ease-in; animation-timing-function: ease-in; }
							50% {
								-webkit-transform: translate3d(-95%, 0, 0) scale3d(0.05, 1, 1);
								transform: translate3d(-95%, 0, 0) scale3d(0.05, 1, 1);
								-webkit-animation-timing-function: ease-out;
								animation-timing-function: ease-out;
							}
							100% { -webkit-transform: translate3d(0, 0, 0) scale3d(1, 1, 1); transform: translate3d(0, 0, 0) scale3d(1, 1, 1); }
						}
						@-webkit-keyframes anim-cordelia-bottom
						{
							0% { -webkit-transform: scale3d(0, 1, 1); transform: scale3d(0, 1, 1); }
							10% { -webkit-transform: scale3d(0.05, 1, 1); transform: scale3d(0.05, 1, 1); -webkit-animation-timing-function: ease-in; animation-timing-function: ease-in; }
							50% {
								-webkit-transform: translate3d(95%, 0, 0) scale3d(0.05, 1, 1);
								transform: translate3d(95%, 0, 0) scale3d(0.05, 1, 1);
								-webkit-animation-timing-function: ease-out;
								animation-timing-function: ease-out;
							}
							100% { -webkit-transform: translate3d(0, 0, 0) scale3d(1, 1, 1); transform: translate3d(0, 0, 0) scale3d(1, 1, 1); }
						}
						@keyframes anim-cordelia-bottom
						{
							0% { -webkit-transform: scale3d(0, 1, 1); transform: scale3d(0, 1, 1); }
							10% { -webkit-transform: scale3d(0.05, 1, 1); transform: scale3d(0.05, 1, 1); -webkit-animation-timing-function: ease-in; animation-timing-function: ease-in; }
							50% {
								-webkit-transform: translate3d(95%, 0, 0) scale3d(0.05, 1, 1);
								transform: translate3d(95%, 0, 0) scale3d(0.05, 1, 1);
								-webkit-animation-timing-function: ease-out;
								animation-timing-function: ease-out;
							}
							100% { -webkit-transform: translate3d(0, 0, 0) scale3d(1, 1, 1); transform: translate3d(0, 0, 0) scale3d(1, 1, 1); }
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect20'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							content: '';
							position: absolute;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transition: -webkit-transform 0.25s, background .75s;
							transition: transform 0.25s, background .75s;
							-webkit-transition-timing-function: cubic-bezier(1, 0.53, 0.79, 0.68);
							transition-timing-function: cubic-bezier(1, 0.53, 0.79, 0.68);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after
						{
							top: 0;
							width: 2px;
							height: 100%;
							-webkit-transform: scale3d(1, 0, 1);
							transform: scale3d(1, 0, 1);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before
						{
							left: 0;
							-webkit-transform-origin: 0% 0%;
							transform-origin: 0% 0%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after
						{
							right: 0;
							-webkit-transform-origin: 50% 0%;
							transform-origin: 50% 0%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							left: 0;
							width: 100%;
							height: 2px;
							-webkit-transform: scale3d(0, 1, 1);
							transform: scale3d(0, 1, 1);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before
						{
							top: 0;
							-webkit-transform-origin: 0 50%;
							transform-origin: 0 50%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::after
						{
							bottom: 0;
							-webkit-transform-origin: 0% 50%;
							transform-origin: 0% 50%;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							bottom: 0;
							-webkit-transition-delay: 0s;
							transition-delay: 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::after
						{
							bottom: 0;
							-webkit-transition-delay: 0.25s;
							transition-delay: 0.25s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button > span::before
						{
							-webkit-transition-delay: 0.25s;
							transition-delay: 0.25s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span::before
						{
							-webkit-transition-delay: 0s;
							transition-delay: 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							top: 0;
							-webkit-transition-delay: 0.25s;
							transition-delay: 0.25s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before
						{
							top: 0;
							-webkit-transition-delay: 0s;
							transition-delay: 0s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span::after
						{
							-webkit-transition-delay: 0.25s;
							transition-delay: 0.25s;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover > span::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::after
						{
							-webkit-transform: scale3d(1, 1, 1);
							transform: scale3d(1, 1, 1);
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect21'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							content: '';
							position: absolute;
							left: 50%;
							top: 50%;
							width: 0;
							height: 0;
							border-radius: 100%;
							border: 2px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transition: all .5s cubic-bezier(.52,.27,.4,1.52);
							transition: all .5s cubic-bezier(.52,.27,.4,1.52);
							opacity: 0;
							-webkit-box-sizing: border-box;
							-moz-box-sizing: border-box;
							box-sizing: border-box;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before
						{
							left: 0;
							top: 0;
							margin-top: 0;
							margin-left: 0;
							width: 100%;
							height: 100%;
							border-radius: 0;
							opacity: 1;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect22'){ ?>
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							content: '';
							position: absolute;
							width: 100px;
							height: 100px;
							opacity: 0;
							border: 2px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							-webkit-transition: -webkit-transform 0.4s, opacity 0.3s, width 0.4s;
							transition: transform .4s, opacity 0.3s, width .4s;
							-webkit-transition-timing-function: linear;
							transition-timing-function: linear;
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::before
						{
							top: 0;
							left: 0;
							border-width: 2px 0 0 2px;
							-webkit-transform: translate3d(-150%, 70%, 0) rotate(-30deg);
							transform: translate3d(-150%, 70%, 0) rotate(-30deg);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button::after
						{
							right: 0;
							bottom: 0;
							border-width: 0 2px 2px 0;
							-webkit-transform: translate3d(150%, -70%, 0) rotate(-30deg);
							transform: translate3d(150%, -70%, 0) rotate(-30deg);
						}
						.filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button.is-checked::after, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::before, .filters-button-group_<?php echo $Total_Soft_Portfolio;?> > button:hover::after
						{
							width: 80%;
							height: 80%;
							opacity: 1;
							-webkit-transform: translate3d(0, 0, 0) rotate(0deg);
							transform: translate3d(0, 0, 0) rotate(0deg);
						}
					<?php }?>
					.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?>
					{
						perspective: 500px;
					}
					.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article img
					{
						vertical-align: middle;
						margin: 0 auto !important;
						display: block;
						max-width: 100%;
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'true'){ ?>
							height: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16;?>px;
						<?php }else{ ?>
							height: auto;
						<?php }?>
						-webkit-filter: blur(0px);
						filter: blur(0px);
					}
					.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article
					{
						display: block;
						float: left;
						margin: 1%;
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 == '2'){ ?>
							width: 48%;
						<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 == '3'){ ?>
							width: 31.3%;
						<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 == '4'){ ?>
							width: 23%;
						<?php }?>
						text-align: center;
						background: #ffffff;
						overflow: hidden;
						position: relative;
						padding: 0 !important;
						border: none !important;
					}
					.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article h3
					{
						box-sizing: border-box;
						-webkit-box-sizing: border-box;
						-moz-box-sizing: border-box;
					}
					.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article ul
					{
						height: 100%;
						background: transparent !important;
					}
					.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article a, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article a:focus, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article a:hover
					{
						text-decoration: none;
						outline: none;
						box-shadow: none;
						-webkit-box-shadow: none;
						-moz-box-shadow: none;
						border-bottom: none;
					}
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect01'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:before
						{
							content: "";
							width: 100%;
							height: 100%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							position: absolute;
							top: 100%;
							left: 0;
							z-index: 1;
							transition: all 0.35s ease-in 0.3s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:before
						{
							top: 0;
							transition: all 0.35s ease-out 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after
						{
							content: "";
							position: absolute;
							bottom: 100%;
							left: 50%;
							border-width: 200px 200px 0 200px;
							border-style: solid;
							border-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> transparent transparent transparent;
							transform: translateX(-50%);
							transition: all 0.35s ease-out 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:after
						{
							bottom: 25%;
							transition: all 0.35s ease-in 0.2s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover img { opacity: 0.5; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							height: 100%;
							position: absolute;
							top: 0;
							left: 0;
							z-index: 1;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							display: inline-block;
							width: 100%;
							padding: 0 30px;
							margin: 0 !important;
							position: absolute;
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							top: 45%;
							left: 0;
							opacity: 0;
							transition: all 0.35s ease 0.5s;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .title
						{
							transform: translate(0, -50%);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon
						{
							width: 100%;
							padding: 0;
							margin: 0;
							list-style: none;
							position: absolute;
							bottom: 0px;
							left: 0;
							opacity: 0;
							transition: all 0.35s ease 0.5s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li { display: inline-block; padding: 0 !important; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li:before { content: "" !important; font-size: 20px; }
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?> { color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>; }
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover { color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>; }
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a { color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>; }
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a:hover { color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
						{
							display: inline-block;
							padding: 0 10px;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
							<?php }?>
							cursor: pointer;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .title, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon { opacity: 1; }
						@media only screen and (max-width:767px) { .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after { border-width: 500px 500px 0 500px; } }
						@media screen and (max-width: 1024px) { .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 20px;	} }
						@media screen and (max-width: 800px) { .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 25px; } }
						@media screen and (max-width: 500px) { .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 35px; } }
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect02'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:before
						{
							content: "";
							width: 100%;
							height: 100%;
							position: absolute;
							top: 0;
							left: 0;
							z-index: 1;
							transition: all 0.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:before
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after
						{
							content: "";
							width: 0;
							height: 200%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							margin: -5px 0 0 -5px;
							position: absolute;
							top: -76%;
							left: 0;
							transform: rotate(30deg);
							transform-origin: 0 0 0;
							z-index: 2;
							transition: all 0.4s ease-out 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:after { width: 70%; left: 10px; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article img
						{
							transition: all 1.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover img
						{
							transform: scale(1.2);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							height: 100%;
							position: absolute;
							top: 0;
							left: 0;
							z-index: 3;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon
						{
							padding: 0;
							list-style: none;
							position: absolute;
							top: -100%;
							left: 0;
							transition: all 0.6s ease 0s;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								margin: 0 0 0 10px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								margin: 0 0 0 25px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								margin: 0 0 0 15px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								margin: 0 0 0 25px;
							<?php }?>
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon { top: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li { display: inline-block; padding: 0 !important; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
						{
							display: block;
							cursor: pointer;
							border-radius: 50%;
							text-align: center;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
								margin: 10px 5px 0 0;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
								margin: 15px 5px 0 0;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
								width: 50px;
								height: 50px;
								line-height: 50px;
								margin: 15px 5px 0 0;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
								width: 55px;
								height: 55px;
								line-height: 55px;
								margin: 20px 5px 0 0;
							<?php }?>
							transition: all 0.6s ease 0s;
						}
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 15px;
								width: 30px;
								height: 30px;
								line-height: 30px;
								margin: 5px 5px 0 0;
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon { margin: 0 0 0 5px; }
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
								margin: 10px 5px 0 0;
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon { margin: 0 0 0 10px; }
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
								margin: 15px 5px 0 0;
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon { margin: 0 0 0 15px; }
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?> !important;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-profile
						{
							padding-right: 10px;
							margin-bottom: 30px;
							text-align: right;
							position: absolute;
							bottom: -100%;
							right: 25px;
							border-right: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;
							transition: all 0.6s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-profile { bottom: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							margin: 0 !important;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect03'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after
						{
							content: "";
							width: 65%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							padding-bottom: 65%;
							opacity: 0;
							position: absolute;
							top: 50%;
							left: 50%;
							transform: rotate(0deg) translate(-50%, -50%);
							transform-origin: 0 0 0;
							transition: all 0.3s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:after
						{
							transform: rotate(-45deg) translate(-50%, -50%);
							opacity: 1;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							position: absolute;
							top: 30%;
							left: 0;
							opacity: 0;
							z-index: 1;
							transition: all 0.3s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content { opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							display: inline-block;
							padding: 7px 0;
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							margin: 0 !important;
							border-top: 2px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;
							border-bottom: 2px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon
						{
							padding: 0;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								margin: 12px 0 0 0;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								margin: 12px 0 0 0;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								margin: 12px 0 0 0;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								margin: 0 !important;
							<?php }?>
							list-style: none;
							width: 100%;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li { display: inline-block; padding: 0 !important; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
						{
							display: block;
							cursor: pointer;
							border-radius: 50%;
							margin-right: 10px;
							transition: all 0.3s ease 0s;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
								margin: 10px 5px 0 0;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
								margin: 15px 5px 0 0;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
								width: 50px;
								height: 50px;
								line-height: 50px;
								margin: 15px 5px 0 0;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
								width: 55px;
								height: 55px;
								line-height: 55px;
								margin: 20px 5px 0 0;
							<?php }?>
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span:hover { border-radius: 0; }
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { top: 20%; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 15px;
								width: 25px;
								height: 25px;
								line-height: 25px;
								margin: 5px 5px 0 0;
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title { padding: 2px 0; }
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { top: 25%; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
								margin: 10px 5px 0 0;
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title { padding: 5px 0; }
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { top: 30%; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
								margin: 15px 5px 0 0;
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title { padding: 7px 0; }
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?> !important;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect04'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after
						{
							content: "";
							width: 90%;
							height: 90%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							border-top: 2px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							border-left: 2px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							position: absolute;
							top: 5%;
							left: 5%;
							transform: scale(0);
							transform-origin: 0 0 0;
							transition: all 0.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after
						{
							border-bottom: 2px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							border-right: 2px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							transform-origin: 100% 100% 0;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:after
						{
							transform: scale(1);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							text-align: center;
							position: absolute;
							top: 30%;
							left: 0;
							opacity: 0;
							z-index: 1;
							transition: all 0.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content { opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							margin: 0 0 10px 0 !important;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon { padding: 0; margin: 0; list-style: none; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li { display: inline-block; padding: 0 !important; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
						{
							display: block;
							cursor: pointer;
							margin-right: 10px;
							transition: all 0.3s ease 0s;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
								width: 50px;
								height: 50px;
								line-height: 50px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
								width: 55px;
								height: 55px;
								line-height: 55px;
							<?php }?>
						}
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { top: 10%; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 15px;
								width: 25px;
								height: 25px;
								line-height: 25px;
								margin: 5px 5px 0 0;
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title { margin: 0px !important; }
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { top: 25%; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
								margin: 10px 5px 0 0;
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title { margin:0 0 5px 0 !important; }
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { top: 30%; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
								margin: 10px 5px 0 0;
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title { margin: 0 0 10px 0 !important; }
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span:hover { border-radius: 50%; }
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?> !important;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect05'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after
						{
							content: "";
							width: 100%;
							height: 100%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							position: absolute;
							top: 0;
							left: -100%;
							transition: all 0.3s ease-in 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:after{ left: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							padding: 20px 30px;
							position: absolute;
							bottom: 0;
							left: 0;
							z-index: 1;
							opacity: 0;
							transition: all 0.5s ease-in 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content{ opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							display: block;
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							text-align: left;
							margin: 0 0 8px 0 !important;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon
						{
							list-style: none;
							padding: 20px 10px 0;
							margin: 0;
							position: absolute;
							top: 0;
							right: 0;
							z-index: 1;
							opacity: 0;
							transition: all 0.5s ease-in 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon{ opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li{ display: inline-block; padding: 0 !important; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
						{
							display: block;
							cursor: pointer;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
								width: 50px;
								height: 50px;
								line-height: 50px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
								width: 55px;
								height: 55px;
								line-height: 55px;
							<?php }?>
							text-align: center;
							margin-right: 10px;
							transition: all 0.5s ease-in 0s;
						}
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon { padding: 6px 3px 0; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 15px;
								width: 25px;
								height: 25px;
								line-height: 25px;
								margin-right: 3px;
							}
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon { padding: 10px 5px 0; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
								margin-right: 5px;
							}
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon { padding: 20px 10px 0; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
								margin-right: 10px;
							}
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?> !important;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect06'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article img
						{
							transition: all 0.3s ease-out 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover img
						{
							transform: scale(1.1);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							height: 100%;
							position: absolute;
							top: 0;
							left: 0;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							opacity: 0;
							cursor: pointer;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content { opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							opacity: 0;
							margin: 0 0 10px !important;
							position: absolute;
							top: 50%;
							left: 0;
							right: 0;
							transform: translateY(-50%);
							-webkit-transform: translateY(-50%);
							-ms-transform: translateY(-50%);
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .title { opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay
						{
							width: 78px;
							height: 78px;
							position: absolute;
							top: 50%;
							left: 50%;
							transform-origin: 0 0;
							transform: rotate(45deg) translate(-50%, -50%);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay:before,
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay:after,
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay div:before,
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay div:after
						{
							content: "";
							display: block;
							position: absolute;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							transition: all 0.4s ease-in-out;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay:before,
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay:after { width: 0; height: 2px; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay div:before,
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay div:after { width: 2px; height: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay:before,
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay div:before { top: 0; left: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay:after,
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content .overlay div:after { bottom: 0; right: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .overlay:before,
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .overlay:after { width: 65%; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .overlay div:before,
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .overlay div:after { height: 65%; }
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect07'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article
						{
							transition: all 0.35s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:before
						{
							content: "";
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 100%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							transition: all 0.35s ease-in 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:before
						{
							right: 0;
							transition: all 0.35s ease-out 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after
						{
							content: "";
							position: absolute;
							top: 50%;
							left: 100%;
							border-width: 200px 200px 200px 0;
							border-style: solid;
							border-color: transparent <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?> transparent transparent;
							transform: translateY(-50%);
							-webkit-transform: translateY(-50%);
							-ms-transform: translateY(-50%);
							transition: all 0.35s ease-out 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:after
						{
							left: 50%;
							transition: all 0.35s ease-in 0.2s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover img { opacity: 0.4; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							height: 100%;
							position: absolute;
							top: 0;
							left: 0;
							z-index: 1;
							cursor: pointer;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							width: 100%;
							padding: 0 20px;
							margin: 0 !important;
							position: absolute;
							top: 50%;
							left: 0;
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							opacity: 0;
							transform: translate(-25%, -50%);
							transition: all 0.3s ease-out 0.2s;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .title
						{
							opacity: 1;
							transform: translate(0, -50%);
							transition-delay: 0.7s;
						}
						@media only screen and (max-width:767px) { .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after { border-width: 800px 800px 800px 0; } }
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect08'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article
						{
							transition: all 0.3s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover
						{
							transform: translateY(-4px);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							height: 100%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							text-align: center;
							opacity: 0;
							position: absolute;
							top: 0;
							left: 0;
							transition: all 0.6s ease 0s;
							display: flex;
							justify-content: center;
							align-items: center;
							cursor: pointer;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content { opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after
						{
							content: "";
							position: absolute;
							top: 20px;
							left: 20px;
							bottom: 20px;
							right: 20px;
							opacity: 0;
							z-index: 1;
							transform: scale(1.5);
							transition: all 0.6s ease 0.2s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before
						{
							border-left: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							border-right: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							left: 30px;
							right: 30px;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after
						{
							border-top: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							border-bottom: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							top: 30px;
							bottom: 30px;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:after
						{
							opacity: 1;
							transform: scale(1);
						}
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before { left: 25px; right: 25px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after { top: 25px; bottom: 25px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:after
							{
								transform: scale(1.2);
							}
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before { left: 35px; right: 35px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after { top: 35px; bottom: 35px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:after
							{
								transform: scale(1);
							}
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before { left: 40px; right: 40px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after { top: 40px; bottom: 40px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:after
							{
								transform: scale(.9);
							}
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							margin: 0 !important;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect09'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:before
						{
							content: "";
							width: 100%;
							height: 100%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							position: absolute;
							top: 0;
							left: 0;
							opacity: 0;
							transition: all 0.35s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:before { opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 90%;
							height: 90%;
							position: absolute;
							top: 5%;
							left: 5%;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after
						{
							content: "";
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
							opacity: 0;
							transition: all 0.7s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before
						{
							border-bottom: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							border-top: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							transform: scale(0, 1);
							transform-origin: 0 0 0;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after
						{
							border-left: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							border-right: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							transform: scale(1, 0);
							transform-origin: 100% 0 0;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:after
						{
							opacity: 1;
							transform: scale(1);
							transition-delay: 0.15s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							display: inline-block;
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							padding: 10px;
							opacity: 0;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;
							border-radius: 0 19px 0 19px;
							transform: translate3d(0px, -50px, 0px);
							transition: all 0.7s ease 0s;
							margin: 10px 0 0 0 !important;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .title
						{
							opacity: 1;
							transform: translate3d(0px, 0px, 0px);
							transition-delay: 0.15s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon
						{
							width: 100%;
							height: initial;
							list-style: none;
							padding: 0;
							margin: 0;
							position: absolute;
							bottom: -10px;
							left: 0;
							opacity: 0;
							z-index: 1;
							transition: all 0.7s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon
						{
							bottom: 20px;
							opacity: 1;
							transition-delay: 0.15s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li { display: inline-block; padding: 0 !important; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
						{
							display: block;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
								width: 50px;
								height: 50px;
								line-height: 50px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
								width: 55px;
								height: 55px;
								line-height: 55px;
							<?php }?>
							border-radius: 0 16px 0 16px;
							margin-right: 5px;
							transition: all 0.4s ease 0s;
							cursor: pointer;
						}
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title { margin: 5px 0 0 0 !important; padding: 5px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon { bottom: 5px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 15px;
								width: 25px;
								height: 25px;
								line-height: 25px;
								margin-right: 3px;
								border-radius: 0 10px 0 10px;
							}
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title { margin: 7px 0 0 0 !important; padding: 7px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon { bottom: 10px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 15px;
								width: 25px;
								height: 25px;
								line-height: 25px;
								margin-right: 3px;
								border-radius: 0 10px 0 10px;
							}
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title { margin: 10px 0 0 0 !important; padding: 10px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon { bottom: 20px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
							{
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
								margin-right: 10px;
								border-radius: 0 17px 0 17px;
							}
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?> !important;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect10'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after
						{
							content: "";
							width: 100%;
							height: 100%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							position: absolute;
							top: 0;
							left: 0;
							opacity: 0;
							transition: all 0.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:after { opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article img
						{
							transition: all 1.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover img
						{
							transform: scale(1.2);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon
						{
							width: 100%;
							height: 100%;
							list-style: none;
							padding: 0;
							margin: 0 auto;
							position: absolute;
							top: 0;
							left: 0;
							z-index: 1;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li { display: inline-block; padding: 0 !important; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
						{
							display: inline-block;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
								width: 50px;
								height: 50px;
								line-height: 50px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
								width: 55px;
								height: 55px;
								line-height: 55px;
							<?php }?>
							border-radius: 50%;
							position: absolute;
							margin: 0 auto;
							cursor: pointer;
							top: 50%;
							opacity: 0;
							transition: all 0.6s ease 0s;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?> !important;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li span { top: 30%; opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li:first-child span { left: -90%; right: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li:first-child span { left: -60px; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li:last-child span { right: -90%; left: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li:last-child span { right: -60px; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							padding: 10px;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							position: absolute;
							bottom: -100px;
							left: 0;
							z-index: 1;
							transition: all 0.6s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content { bottom: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							margin: 0 !important;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 15px; width: 25px; height: 25px; line-height: 25px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li:first-child span { left: -35px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li:last-child span { right: -35px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li span { top: 25%; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { padding: 5px; }
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 20px; width: 40px; height: 40px; line-height: 40px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li:first-child span { left: -50px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li:last-child span { right: -50px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li span { top: 25%; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { padding: 10px; }
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 30px; width: 50px; height: 50px; line-height: 50px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li:first-child span { left: -60px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li:last-child span { right: -60px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li span { top: 30%; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { padding: 20px 10px; }
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect11'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							height: 100%;
							position: absolute;
							top: 0;
							left: 0;
							transition: all 0.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content
						{
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after
						{
							content: "";
							width: 50px;
							height: 50px;
							position: absolute;
							opacity: 0;
							transform: scale(1.5);
							transition: all 0.6s ease 0.3s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before
						{
							border-left: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							border-top: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							top: 19px;
							left: 19px;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after
						{
							border-bottom: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							border-right: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							bottom: 19px;
							right: 19px;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:after
						{
							opacity: 1;
							transform: scale(1);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							margin: 0 !important;
							position: relative;
							top: 0;
							opacity: 0;
							transition: all 1s ease 0.01s;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .title
						{
							top: 50%;
							transform: translateY(-100%);
							-webkit-transform: translateY(-100%);
							-moz-transform: translateY(-100%);
							opacity: 1;
							transition: all 0.5s cubic-bezier(1, -0.53, 0.405, 1.425) 0.01s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title:after
						{
							content: "";
							width: 0;
							height: 1px;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;
							position: absolute;
							bottom: -8px;
							left: 0;
							right: 0;
							margin: 0 auto;
							transition: all 1s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .title:after
						{
							width: 80%;
							transition: all 1s ease 0.8s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon
						{
							width: 100%;
							height: initial;
							list-style: none;
							padding: 0;
							margin: 0 auto;
							position: absolute;
							left: 0;
							bottom: 0;
							opacity: 0;
							transition-duration: 0.6s;
							transition-timing-function: cubic-bezier(1, -0.53, 0.405, 1.425);
							transition-delay: 0.1s;
							z-index: 10;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon { bottom: 10px; opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li { display: inline-block; padding: 0 !important; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
						{
							display: block;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
								width: 50px;
								height: 50px;
								line-height: 50px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
								width: 55px;
								height: 55px;
								line-height: 55px;
							<?php }?>
							border-radius: 50%;
							margin-right: 5px;
							cursor: pointer;
							transition: all 0.3s ease-in-out 0s;
						}
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 15px; width: 25px; height: 25px; line-height: 25px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon { bottom: 3px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before { top: 5px; left: 5px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after { bottom: 5px; right: 5px; }
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 20px; width: 40px; height: 40px; line-height: 40px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon { bottom: 10px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before { top: 10px; left: 10px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after { bottom: 10px; right: 10px; }
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 25px; width: 45px; height: 45px; line-height: 45px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon { bottom: 20px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before { top: 20px; left: 20px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after { bottom: 20px; right: 20px; }
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?> !important;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect12'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after
						{
							content: "";
							width: 100%;
							height: 100%;
							position: absolute;
							top: 0;
							left: 0;
							transition: all 0.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:after
						{
							background: linear-gradient(to bottom, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							height: 100%;
							position: absolute;
							bottom: 0;
							left: 0;
							z-index: 1;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							margin:0 !important;
							transform: translateY(100%);
							top: 50%;
							position: relative;
							transition: all 0.4s cubic-bezier(0.13, 0.62, 0.81, 0.91) 0s;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .title
						{
							transform: translateY(-100%);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon
						{
							list-style: none;
							padding: 0 0 5px 0;
							top: 50%;
							opacity: 0;
							position: relative;
							display: block;
							transform: perspective(500px) rotateX(-90deg) rotateY(0deg) rotateZ(0deg) translateY(0%);
							transition: all 0.6s cubic-bezier(0, 0, 0.58, 1) 0s;
							margin: 0;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon
						{
							opacity: 1;
							transform: perspective(500px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) translateY(0%);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon:before
						{
							content: "";
							width: 50px;
							height: 2px;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>;
							margin: 0 auto;
							position: absolute;
							top: -10px;
							left: 0;
							right: 0;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li { display: inline-block; padding: 0 !important; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
						{
							display: block;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
								width: 50px;
								height: 50px;
								line-height: 50px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
								width: 55px;
								height: 55px;
								line-height: 55px;
							<?php }?>
							border-radius: 50%;
							margin-right: 10px;
							transition: all 0.3s ease 0s;
							cursor: pointer;
						}
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 15px; width: 25px; height: 25px; line-height: 25px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon
							{
								transform: perspective(500px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) translateY(-25%);
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon:before { top: -5px; }
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 20px; width: 40px; height: 40px; line-height: 40px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon
							{
								transform: perspective(500px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) translateY(-10%);
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon:before { top: -7px; }
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 20px; width: 40px; height: 40px; line-height: 40px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon
							{
								transform: perspective(500px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) translateY(0%);
							}
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon:before { top: -10px; }
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?> !important;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li:last-child span { margin-right: 0; }
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect13'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:after
						{
							content: "";
							width: 100%;
							height: 100%;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							position: absolute;
							top: 0;
							left: 0;
							opacity: 0;
							transition: all 0.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:after { opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>;
							padding: 10px 0;
							position: absolute;
							bottom: -100%;
							left: 0;
							z-index: 1;
							transition: all 0.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content { bottom: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							margin: 0 !important;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon
						{
							width: 100%;
							list-style: none;
							padding: 0;
							margin: 0;
							position: absolute;
							top: 0;
							left: 0;
							z-index: 1;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li
						{
							display: inline-block;
							margin-right: 7px;
							position: relative;
							transform: translateY(-101%);
							transition: all 0.5s ease 0s;
							padding: 0 !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li:first-child
						{
							transition-delay: 0.5s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li:last-child
						{
							transition-delay: 0.8s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li:before
						{
							content: "";
							position: absolute;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								height: 20px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								height: 30px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								height: 35px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								height: 45px;
							<?php }?>
							width: 1px;
							top: 0;
							left: 0;
							right: 0;
							margin: 0 auto;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li
						{
							transform: translateY(0);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
						{
							display: block;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
								margin-top: 20px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
								margin-top: 30px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
								width: 50px;
								height: 50px;
								line-height: 50px;
								margin-top: 35px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
								width: 55px;
								height: 55px;
								line-height: 55px;
								margin-top: 45px;
							<?php }?>
							border-radius: 50%;
							opacity: 1;
							transition: all 0.3s ease 0s;
							cursor: pointer;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li span { opacity: 1; }
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 15px; width: 25px; height: 25px; line-height: 25px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li:before { height: 10px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { margin-top: 10px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { padding: 3px 0; }
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 20px; width: 40px; height: 40px; line-height: 40px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li:before { height: 20px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { margin-top: 20px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { padding: 7px 0; }
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 20px; width: 40px; height: 40px; line-height: 40px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li:before { height: 30px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { margin-top: 30px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { padding: 10px 0; }
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						}
						.TSPortfolioHE_Popup1_<?php echo $Total_Soft_Portfolio;?>:before
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
						}
						.TSPortfolioHE_Link1_<?php echo $Total_Soft_Portfolio;?>:before
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?> !important;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect14'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:before
						{
							content: "";
							width: 0;
							height: 100%;
							padding: 14px 18px;
							position: absolute;
							top: 0;
							left: 50%;
							transition: all 500ms cubic-bezier(0.47, 0, 0.745, 0.715) 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover:before
						{
							width: 100%;
							left: 0;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content
						{
							width: 100%;
							position: absolute;
							top: 50%;
							transform: translateY(-50%);
							-webkit-transform: translateY(-50%);
							-ms-transform: translateY(-50%);
							left: 0;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							margin: 0 !important;
							opacity: 0;
							transition: all 0.5s ease 0s;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .title
						{
							opacity: 1;
							transition-delay: 0.7s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon { padding: 0; margin: 0; list-style: none; margin-top: 15px; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li { display: inline-block; padding: 0 !important; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span
						{
							display: block;
							cursor: pointer;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
								width: 50px;
								height: 50px;
								line-height: 50px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
								width: 55px;
								height: 55px;
								line-height: 55px;
							<?php }?>
							border-radius: 50%;
							margin-right: 5px;
							opacity: 0;
							transform: translateY(50px);
							transition: all 0.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li span
						{
							opacity: 1;
							transform: translateY(0px);
							transition-delay: 0.5s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .icon li:last-child span
						{
							transition-delay: 0.8s;
						}
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 15px; width: 25px; height: 25px; line-height: 25px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon { margin-top: 5px; }
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 20px; width: 40px; height: 40px; line-height: 40px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon { margin-top: 10px; }
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon li span { font-size: 25px; width: 45px; height: 45px; line-height: 45px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .icon { margin-top: 15px; }
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?> !important;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						}
					<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect15'){ ?>
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content { width: 100%; height: 100%; position: absolute; top: 0; left: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before, .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after
						{
							content: "";
							width: 95%;
							height: 47%;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							position: absolute;
							left: 0;
							right: 0;
							margin: auto;
							opacity: 0;
							transition: all 0.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:before { top: -20%; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:before { top: 3%; opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .box-content:after { bottom: -20%; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .box-content:after { bottom: 3%; opacity: 1; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .content
						{
							width: 100%;
							height: 45px;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
							text-align: center;
							margin: auto;
							opacity: 0;
							transform: rotate(90deg);
							z-index: 1;
							transition: all 0.5s ease 0s;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .content h3 { margin: 0; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article:hover .content
						{
							opacity: 1;
							transform: rotate(0deg);
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .social { padding: 0; margin: 0 0 20px 0; list-style: none; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .social li { display: inline-block; margin-right: 10px; padding: 0 !important; }
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .social li span
						{
							display: block;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size1'){ ?>
								font-size: 20px;
								width: 40px;
								height: 40px;
								line-height: 40px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size2'){ ?>
								font-size: 25px;
								width: 45px;
								height: 45px;
								line-height: 45px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size3'){ ?>
								font-size: 30px;
								width: 50px;
								height: 50px;
								line-height: 50px;
							<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03 == 'Size4'){ ?>
								font-size: 35px;
								width: 55px;
								height: 55px;
								line-height: 55px;
							<?php }?>
							border-radius: 50%;
							transition: all 0.3s ease 0s;
							cursor: pointer;
						}
						@media screen and (max-width: 1024px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .social li span { font-size: 15px; width: 25px; height: 25px; line-height: 25px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .social { margin: 0 0 5px 0; }
						}
						@media screen and (max-width: 800px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .social li span { font-size: 20px; width: 40px; height: 40px; line-height: 40px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .social { margin: 0 0 10px 0; }
						}
						@media screen and (max-width: 500px)
						{
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .social li span { font-size: 25px; width: 45px; height: 45px; line-height: 45px; }
							.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .social { margin: 0 0 15px 0; }
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>;
						}
						.TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?> !important;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?> a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?> !important;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						}
						.TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>:hover a
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?> !important;
						}
						.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article .title
						{
							font-weight: 400 !important;
							line-height: 1 !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?> !important;
							font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?> !important;
							font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>px !important;
							margin:0 0 7px 0 !important;
							letter-spacing: 0 !important;
							text-transform: none !important;
						}
					<?php }?>
					/* Overlay */
					.TSPortfolioHE_Ov_<?php echo $Total_Soft_Portfolio;?>
					{
						position: fixed;
						display: none;
						width: 100%;
						height: 100%;
						top: 0;
						left: 0;
						background: rgba(0,0,0,0.1);
						z-index: 10000000;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?>
					{
						position: fixed;
						display: none;
						width: 100%;
						max-height: 80%;
						top: 50%;
						left: 0;
						z-index: 10000001;
						transform: translateY(-50%);
						-webkit-transform: translateY(-50%);
						-moz-transform: translateY(-50%);
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div1
					{
						position: relative;
						margin: 0 auto;
						width: 70%;
						height: inherit;
						display: none;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div2
					{
						position: relative;
						display: flex;
						display: -webkit-flex;
						float: left;
						width: 60%;
						background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34;?>;
						height: 100%;
						justify-content: center;
						align-items: center;
						overflow: hidden;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div3
					{
						position: relative;
						display: block;
						float: right;
						width: 40%;
						background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_38;?>;
						padding: 15px; 
						overflow: auto;
						cursor: default;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div3 h3
					{
						text-transform: none !important;
						line-height: 1 !important;
						margin: 0 !important;
						padding: 5px 0 15px 0 !important;
						font-weight: 400 !important;
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39;?> !important;
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>px !important;
						font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?> !important;
						text-align: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?> !important;
						letter-spacing: 0 !important;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div3 p { line-height: 1.3 !important; margin: 0 !important; }
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div3::-webkit-scrollbar { width: 9px; }
					/* Track */
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div3::-webkit-scrollbar-track { background: none; }
					/* Handle */
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div3::-webkit-scrollbar-thumb
					{
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_38;?>;
						border:1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39;?>;
						border-radius: 10px;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div3::-webkit-scrollbar-thumb:hover
					{
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39;?>;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> img
					{
						max-width: 100%;
						width: auto;
						max-height: 100%;
						height: auto;
						margin: 0 !important;
						-webkit-backface-visibility: hidden;
						-ms-transform: translateZ(0);
						-webkit-transform: translateZ(0);
						transform: translateZ(0);
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div2 span
					{
						background: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
						position: absolute;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
						left: 0px;
						display: flex;
						display: -webkit-flex;
						justify-content: center;
						align-items: center;
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?>px;
						padding: 15px 5px;
						transform: translateX(-100%);
						transition: all .5s;
						cursor: pointer;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div2 span:hover
					{
						background: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?>;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div2 span:last-child
					{
						right: 0px;
						left: auto;
						transform: translateX(100%);
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div2:hover .TSPortfolioHE_Ov_Div_Span_<?php echo $Total_Soft_Portfolio;?>
					{
						transform: translateX(0%);
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4
					{
						position:fixed;
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size1'){ ?>
							height:30px;
							width:30px;
							top:-30px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size2'){ ?>
							height:40px;
							width:40px;
							top:-40px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size3'){ ?>
							height:60px;
							width:60px;
							top:-60px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size4'){ ?>
							height:70px;
							width:70px;
							top:-70px;
						<?php }?>
						right:0;
						background: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?>;
						cursor: pointer;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4:hover
					{
						background: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_10;?>;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4:hover span:before, .TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4:hover span:after
					{
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_11;?>;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span
					{
						display:block;
						position:absolute;
						overflow:hidden;
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size1'){ ?>
							height:26px;
							width:26px;
							right:2px;
							top:2px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size2'){ ?>
							height:30px;
							width:30px;
							right:5px;
							top:5px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size3'){ ?>
							height:50px;
							width:50px;
							right:5px;
							top:5px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size4'){ ?>
							height:50px;
							width:50px;
							right:10px;
							top:10px;
						<?php }?>
						text-indent:-5000px;
						-webkit-transform:rotate(45deg);
						-moz-transform:rotate(45deg);
						-ms-transform:rotate(45deg);
						-o-transform:rotate(45deg);
						transform:rotate(45deg);
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span:before
					{
						content:'';
						display:block;
						position:absolute;
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size1'){ ?>
							height:26px;
							width:2px;
							left:12px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size2'){ ?>
							height:30px;
							width:2px;
							left:14px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size3'){ ?>
							height:50px;
							width:2px;
							left:24px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size4'){ ?>
							height:50px;
							width:3px;
							left:24px;
						<?php }?>
						top:0;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_09;?>;
						border-radius:2px;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span:after
					{
						content:'';
						display:block;
						position:absolute;
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size1'){ ?>
							width:26px;
							height:2px;
							top:12px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size2'){ ?>
							width:30px;
							height:2px;
							top:14px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size3'){ ?>
							width:50px;
							height:2px;
							top:24px;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size4'){ ?>
							width:50px;
							height:3px;
							top:24px;
						<?php }?>
						left:0;
						background:<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_09;?>;
						border-radius:2px;
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span.tsportspan:before
					{
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size1'){ ?>
							-webkit-animation: TSPortfolioHE_Ov_Spana_c .5s;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size2'){ ?>
							-webkit-animation: TSPortfolioHE_Ov_Spana_b .5s;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size3'){ ?>
							-webkit-animation: TSPortfolioHE_Ov_Spana_a .5s;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size4'){ ?>
							-webkit-animation: TSPortfolioHE_Ov_Spana .5s;
						<?php }?>
					}
					.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span.tsportspan:after
					{
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size1'){ ?>
							-webkit-animation: TSPortfolioHE_Ov_Spanb_c .5s;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size2'){ ?>
							-webkit-animation: TSPortfolioHE_Ov_Spanb_b .5s;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size3'){ ?>
							-webkit-animation: TSPortfolioHE_Ov_Spanb_a .5s;
						<?php } else if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07 == 'Size4'){ ?>
							-webkit-animation: TSPortfolioHE_Ov_Spanb .5s;
						<?php }?>
					}
					@-webkit-keyframes TSPortfolioHE_Ov_Spana { 0% {height: 3px;} 20% {height: 10px;} 40% {height: 20px;} 60% {height: 30px;} 80% {height: 40px;} 100% {height: 50px;} }
					@-webkit-keyframes TSPortfolioHE_Ov_Spana_a { 0% {height: 2px;} 20% {height: 10px;} 40% {height: 20px;} 60% {height: 30px;} 80% {height: 40px;} 100% {height: 50px;} }
					@-webkit-keyframes TSPortfolioHE_Ov_Spana_b { 0% {height: 2px;} 20% {height: 7px;} 40% {height: 12px;} 60% {height: 19px;} 80% {height: 25px;} 100% {height: 30px;} }
					@-webkit-keyframes TSPortfolioHE_Ov_Spana_c { 0% {height: 2px;} 20% {height: 5px;} 40% {height: 10px;} 60% {height: 15px;} 80% {height: 20px;} 100% {height: 26px;} }
					@-webkit-keyframes TSPortfolioHE_Ov_Spanb { 0% {width: 3px;} 20% {width: 10px;} 40% {width: 20px;} 60% {width: 30px;} 80% {width: 40px;} 100% {width: 50px;} }
					@-webkit-keyframes TSPortfolioHE_Ov_Spanb_a { 0% {width: 2px;} 20% {width: 10px;} 40% {width: 20px;} 60% {width: 30px;} 80% {width: 40px;} 100% {width: 50px;} }
					@-webkit-keyframes TSPortfolioHE_Ov_Spanb_b { 0% {width: 2px;} 20% {width: 7px;} 40% {width: 12px;} 60% {width: 19px;} 80% {width: 25px;} 100% {width: 30px;} }
					@-webkit-keyframes TSPortfolioHE_Ov_Spanb_c { 0% {width: 2px;} 20% {width: 5px;} 40% {width: 10px;} 60% {width: 15px;} 80% {width: 20px;} 100% {width: 26px;} }
					@media screen and (max-width: 1024px)
					{
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span.tsportspan:before
						{
							-webkit-animation: TSPortfolioHE_Ov_Spana_a .5s;
						}
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span.tsportspan:after
						{
							-webkit-animation: TSPortfolioHE_Ov_Spanb_a .5s;
						}
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 { height:60px; width:60px; top:-60px; }
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span { height:50px; width:50px; right:5px; top:5px; }
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span:before { height:50px; width:2px; left:24px; }
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span:after { width:50px; height:2px; top:24px; }
					}
					@media screen and (max-width: 820px)
					{
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 { height:40px; width:40px; top:-40px; }
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span { height:30px; width:30px; right:5px; top:5px; }
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span:before { height:30px; width:2px; left:14px; }
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span:after { width:30px; height:2px; top:14px; }
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span.tsportspan:before
						{
							-webkit-animation: TSPortfolioHE_Ov_Spana_b .5s;
						}
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span.tsportspan:after
						{
							-webkit-animation: TSPortfolioHE_Ov_Spanb_b .5s;
						}
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div2 span
						{
							transform: translateX(0) !important;
							-moz-transform: translateX(0) !important;
							-webkit-transform: translateX(0) !important;
						}
					}
					@media screen and (max-width: 500px)
					{
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 { height:30px; width:30px; top:-30px; }
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span { height:26px; width:26px; right:2px; top:2px; }
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span:before { height:26px; width:2px; left:12px; }
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span:after { width:26px; height:2px; top:12px; }
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span.tsportspan:before
						{
							-webkit-animation: TSPortfolioHE_Ov_Spana_c .5s;
						}
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div4 span.tsportspan:after
						{
							-webkit-animation: TSPortfolioHE_Ov_Spanb_c .5s;
						}
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div1, .TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div2, .TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div3
						{
							width: 100%;
						}
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div2
						{
							height: auto;
						}
						.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div3
						{
							max-height: 250px;
						}
					}
					@media (max-width: 1024px) { .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article { width: 31.3%; } }
					@media (max-width: 800px) { .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article { width: 48%; } }
					@media (max-width: 500px) { .TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?> article { width: 100%; margin: 2% 0; } }
				</style>
				<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02 == 'true'){ ?>
					<div class="button-group filters-button-group filters-button-group_<?php echo $Total_Soft_Portfolio;?>">
						<div></div>
						<button class="button is-checked TSPortfolioHE_Button_<?php echo $Total_Soft_Portfolio;?>" data-filter="*">
							<span class="TSPortfolioHE_Button_Span_<?php echo $Total_Soft_Portfolio;?>"><?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01;?></span>
						</button>
						<?php for($i=0;$i<$TotalSoftPortfolioManager[0]->TotalSoftPortfolio_AlbumCount;$i++){ ?>
							<button class="button TSPortfolioHE_Button_<?php echo $Total_Soft_Portfolio;?>" data-filter=".<?php echo str_replace(" ","_", $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle) . $Total_Soft_Portfolio;?>">
								<span class="TSPortfolioHE_Button_Span_<?php echo $Total_Soft_Portfolio;?>"><?php echo $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle;?></span>
							</button>
						<?php }?>
					</div>
				<?php }?>
				<section id="grid-container" class="transitions-enabled fluid masonry js-masonry TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?>">
					<?php for($i=0;$i<count($TotalSoftPortfolioImages);$i++){ ?>
						<article class="<?php echo str_replace(" ","_", $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IA) . $Total_Soft_Portfolio;?>">
							<img src="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>" class="img-responsive" />
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect01' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect03' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect04' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect09' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect11' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect12' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect14'){ ?>
								<div class="box-content">
									<h3 class="title"><?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?></h3>
									<ul class="icon">
										<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33 == 'true'){ ?>
											<li onclick="OpenTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>, <?php echo $i+1;?>)" class="TSPortfolioHE_Popup1_<?php echo $Total_Soft_Portfolio;?>">
												<span class="TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>"></span>
											</li>
										<?php }?>
										<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink!=''){ ?>
											<li class="TSPortfolioHE_Link1_<?php echo $Total_Soft_Portfolio;?>">
												<span class="TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>">
													<a class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>" href="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink;?>" target="<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IONT == 'true'){ echo '_blank';} ?>"></a>
												</span>
											</li>
										<?php } ?>
									</ul>
								</div>
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect02'){ ?>
								<div class="box-content">
									<ul class="icon">
										<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33 == 'true'){ ?>
											<li onclick="OpenTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>, <?php echo $i+1;?>)" class="TSPortfolioHE_Popup1_<?php echo $Total_Soft_Portfolio;?>">
												<span class="TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>"></span>
											</li>
										<?php }?>
										<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink!=''){ ?>
											<li class="TSPortfolioHE_Link1_<?php echo $Total_Soft_Portfolio;?>">
												<span class="TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>">
													<a class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>" href="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink;?>" target="<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IONT == 'true'){ echo '_blank';} ?>"></a>
												</span>
											</li>
										<?php } ?>
									</ul>
									<div class="box-profile">
										<h3 class="title"><?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?></h3>
									</div>
								</div>
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect05' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect10' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect13'){ ?>
								<div class="box-content">
									<h3 class="title"><?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?></h3>
								</div>
								<ul class="icon">
									<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33 == 'true'){ ?>
										<li onclick="OpenTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>, <?php echo $i+1;?>)" class="TSPortfolioHE_Popup1_<?php echo $Total_Soft_Portfolio;?>">
											<span class="TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>"></span>
										</li>
									<?php }?>
									<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink!=''){ ?>
										<li class="TSPortfolioHE_Link1_<?php echo $Total_Soft_Portfolio;?>">
											<span class="TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>">
												<a class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>" href="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink;?>" target="<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IONT == 'true'){ echo '_blank';} ?>"></a>
											</span>
										</li>
									<?php } ?>
								</ul>
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect06'){ ?>
								<div class="box-content" <?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33 == 'true'){ ?> onclick="OpenTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>, <?php echo $i+1;?>)" <?php }?>>
									<div class="overlay"><div></div></div>
									<h3 class="title"><?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?></h3>
								</div>
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect07' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect08'){ ?>
								<div class="box-content" <?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33 == 'true'){ ?> onclick="OpenTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>, <?php echo $i+1;?>)" <?php }?>>
									<h3 class="title"><?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?></h3>
								</div>
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17 == 'effect15'){ ?>
								<div class="box-content">
									<div class="content">
										<ul class="social">
											<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33 == 'true'){ ?>
												<li onclick="OpenTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>, <?php echo $i+1;?>)" class="TSPortfolioHE_Popup1_<?php echo $Total_Soft_Portfolio;?>">
													<span class="TSPortfolioHE_Popup_<?php echo $Total_Soft_Portfolio;?>">
														<i class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>"></i>
													</span>
												</li>
											<?php }?>
											<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink!=''){ ?>
												<li class="TSPortfolioHE_Link1_<?php echo $Total_Soft_Portfolio;?>">
													<span class="TSPortfolioHE_Link_<?php echo $Total_Soft_Portfolio;?>">
														<a class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>" href="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink;?>" target="<?php if($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IONT == 'true'){ echo '_blank';} ?>"></a>
													</span>
												</li>
											<?php } ?>
										</ul>
										<h3 class="title"><?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?></h3>
									</div>
								</div>
							<?php }?>
						</article>
					<?php }?>
				</section>
				<div class="TSPortfolioHE_Ov TSPortfolioHE_Ov_<?php echo $Total_Soft_Portfolio;?>" onclick="CloseTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>)"></div>
				<div class="TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?>">
					<input type="text" style="display: none;" class="TSPortfolioHE_Ov_Div_Num_<?php echo $Total_Soft_Portfolio;?>" value="novalue">
					<?php for($i=0;$i<count($TotalSoftPortfolioImages);$i++){ 
						if($i == 0) { $prevImage = count($TotalSoftPortfolioImages); } else { $prevImage = $i; }
						if($i == count($TotalSoftPortfolioImages)-1) { $nextImage = 1; } else { $nextImage = $i+2; }
					?>
						<div class="TSPortfolioHE_Ov_Div1 TSPortfolioHE_Ov_Div1_<?php echo $i+1;?>">
							<div class="TSPortfolioHE_Ov_Div2">
								<img src="<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>">
								<span class="TSPortfolioHE_Ov_Div_Span_<?php echo $Total_Soft_Portfolio;?>" onclick="OpenTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>, <?php echo $prevImage;?>)">
									<i class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?>-left"></i>
								</span>
								<span class="TSPortfolioHE_Ov_Div_Span_<?php echo $Total_Soft_Portfolio;?>" onclick="OpenTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>, <?php echo $nextImage;?>)">
									<i class="totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01;?>-right"></i>
								</span>
							</div>
							<div class="TSPortfolioHE_Ov_Div3">
								<h3><?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?></h3>
								<?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IDesc);?>
							</div>
							<div class="TSPortfolioHE_Ov_Div4" onclick="CloseTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>)">
								<span></span>
							</div>
						</div>
					<?php }?>
				</div>
				<script type="text/javascript">
					jQuery(window).on("load resize", function(){
						var $grid = jQuery('.TSPortfolioHE_<?php echo $Total_Soft_Portfolio;?>').isotope({ itemSelector: 'article', });
						jQuery('.filters-button-group_<?php echo $Total_Soft_Portfolio;?>').on( 'click', 'button', function() {
							var filterValue = jQuery( this ).attr('data-filter');
							$grid.isotope({ filter: filterValue });
						});
						jQuery('.filters-button-group_<?php echo $Total_Soft_Portfolio;?>').each( function( i, buttonGroup ) {
							var $buttonGroup = jQuery( buttonGroup );
							$buttonGroup.on( 'click', 'button', function() { $buttonGroup.find('.is-checked').removeClass('is-checked'); jQuery( this ).addClass('is-checked'); });
						});
					});
					// debounce so filtering doesn't happen every millisecond
					function debounce( fn, threshold ) {
						var timeout;
						return function debounced() {
							if ( timeout ) { clearTimeout( timeout ); }
							function delayed() { fn(); timeout = null; }
							timeout = setTimeout( delayed, threshold || 100 );
						}
					}
					jQuery(window).bind("load", function() {
						jQuery('.TSPortfolioHE_Button_<?php echo $Total_Soft_Portfolio;?>.is-checked').click();

						var k = 0;
						jQuery('.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div1').each(function(){
							k++;
						})
						jQuery("body").keydown(function(event){
							var num = jQuery('.TSPortfolioHE_Ov_Div_Num_<?php echo $Total_Soft_Portfolio;?>').val();
							if(num != 'novalue')
							{
								if(event.which == 27)
								{
									CloseTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>);
									return;
								}
								else if(event.which == 37)
								{
									if(parseInt(parseInt(num)-1) == 0) { var prevImage = k; } else { var prevImage = parseInt(parseInt(num)-1); }

									OpenTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>, prevImage);
									return;
								}
								else if(event.which == 39)
								{
									if(parseInt(parseInt(num)+1) == k+1) { var nextImage = 1; } else { var nextImage = parseInt(parseInt(num)+1); }
									OpenTSPortfolioHE_Pop(<?php echo $Total_Soft_Portfolio;?>, nextImage);
									return;
								}
							}
						});
					});
					jQuery(window).resize(function(){
						jQuery('.TSPortfolioHE_Ov_Div_<?php echo $Total_Soft_Portfolio;?> .TSPortfolioHE_Ov_Div1').each(function(){
							if(jQuery(window).width() > 500)
							{
								if(jQuery(this).css('display') == 'block')
								{
									jQuery(this).css('display','flex');
									jQuery(this).css('display','-webkit-flex');
								}
							}
							else
							{
								if(jQuery(this).css('display') == 'flex' || jQuery(this).css('display') == '-webkit-flex')
								{
									jQuery(this).css('display','block');
								}
							}
						})
					})
					function OpenTSPortfolioHE_Pop(Port_id, num) {
						jQuery('.TSPortfolioHE_Ov_Div_Num_'+Port_id).val(num);
						if(jQuery(window).width() > 500)
						{
							jQuery('.TSPortfolioHE_Ov_'+Port_id).css('display','flex');
							jQuery('.TSPortfolioHE_Ov_'+Port_id).css('display','-webkit-flex');
							jQuery('.TSPortfolioHE_Ov_Div_'+Port_id).css('display','flex');
							jQuery('.TSPortfolioHE_Ov_Div_'+Port_id).css('display','-webkit-flex');
							jQuery('.TSPortfolioHE_Ov_Div1').css('display','none');
							jQuery('.TSPortfolioHE_Ov_Div1_'+num).css('display','flex');
							jQuery('.TSPortfolioHE_Ov_Div1_'+num).css('display','-webkit-flex');
							jQuery('.TSPortfolioHE_Ov_Div1_'+num+' .TSPortfolioHE_Ov_Div4 span').addClass('tsportspan');
						}
						else
						{
							jQuery('.TSPortfolioHE_Ov_'+Port_id).css('display','flex');
							jQuery('.TSPortfolioHE_Ov_'+Port_id).css('display','-webkit-flex');
							jQuery('.TSPortfolioHE_Ov_Div_'+Port_id).css('display','flex');
							jQuery('.TSPortfolioHE_Ov_Div_'+Port_id).css('display','-webkit-flex');
							jQuery('.TSPortfolioHE_Ov_Div1').css('display','none');
							jQuery('.TSPortfolioHE_Ov_Div1_'+num).css('display','block');
							jQuery('.TSPortfolioHE_Ov_Div1_'+num+' .TSPortfolioHE_Ov_Div4 span').addClass('tsportspan');
						}
					}
					function CloseTSPortfolioHE_Pop(Port_id) {
						jQuery('.TSPortfolioHE_Ov_Div_Num_'+Port_id).val('novalue');
						jQuery('.TSPortfolioHE_Ov_'+Port_id).css('display','none');
						jQuery('.TSPortfolioHE_Ov_Div_'+Port_id).css('display','none');
						jQuery('.TSPortfolioHE_Ov_Div1').css('display','none');
					}
				</script>
			<?php } else if($TotalSoftPortfolioOpt[0]->TotalSoftPortfolio_SetType == 'Lightbox Gallery'){ ?>
				<script src="<?php echo plugins_url('../JS/angular.min.js',__FILE__);?>" type="text/javascript"></script>
				<script src="<?php echo plugins_url('../JS/angular-animate.min.js',__FILE__);?>" type="text/javascript"></script>
				<style type="text/css">
					.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?> *, .TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> *
					{
						-webkit-box-sizing: border-box !important;
						-moz-box-sizing: border-box !important;
						box-sizing: border-box !important;
					}
					@-webkit-keyframes up-in { from { opacity: 0; bottom: 0%; } to { opacity: 1; bottom: 50%; } }
					@keyframes up-in { from { opacity: 0; bottom: 0%; } to { opacity: 1; bottom: 50%; } }
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .fill
					{
						background-repeat: no-repeat;
						background-position: center center;
						background-size: cover;
						background-attachment: fixed;
					}
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .flex-row
					{
						display: -webkit-box;
						display: -ms-flexbox;
						display: flex;
						-webkit-box-orient: horizontal;
						-webkit-box-direction: normal;
						-ms-flex-direction: row;
						flex-direction: row;
						-ms-flex-wrap: wrap;
						flex-wrap: wrap;
						-ms-flex-pack: distribute;
						justify-content: space-around;
					}
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?>
					{
						display: -webkit-box;
						display: -ms-flexbox;
						display: flex;
						-webkit-box-orient: horizontal;
						-webkit-box-direction: normal;
						-ms-flex-direction: row;
						flex-direction: row;
						-ms-flex-wrap: wrap;
						flex-wrap: wrap;
						-ms-flex-pack: distribute;
						justify-content: space-around;
						width: 100%;
						min-height: 100%;
						height: 100%;
						overflow: auto;
						background-color: white;
						position: relative;
					}
					.og-expander<?php echo $Total_Soft_Portfolio; ?>::-webkit-scrollbar-thumb:hover {background:#cecece;}
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?>.no-scroll<?php echo $Total_Soft_Portfolio;?> { overflow: hidden; }
					.TotalSoft_PG_LG_Page_<?php echo $Total_Soft_Portfolio;?> { width: 100%; }
					.TotalSoft_PG_LG_Grid_<?php echo $Total_Soft_Portfolio;?>
					{
						display: -webkit-box;
						display: -ms-flexbox;
						display: flex;
						-webkit-box-orient: horizontal;
						-webkit-box-direction: normal;
						-ms-flex-direction: row;
						flex-direction: row;
						-ms-flex-wrap: wrap;
						flex-wrap: wrap;
						-ms-flex-pack: distribute;
						justify-content: center;
					}
					.TotalSoft_PG_LG_Grid_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>
					{
						width: <?php echo floor(100/$TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14);?>%;
						position: relative;
						-webkit-transform: scale(0) translateZ(0);
						-moz-transform: scale(0) translateZ(0);
						transform: scale(0) translateZ(0);
						-webkit-transition: all 350ms ease;
						-moz-transition: all 350ms ease;
						transition: all 350ms ease;
						perspective: 800px;
						-moz-perspective: 800px;
						-webkit-perspective: 800px;
					}
					.TotalSoft_PG_LG_Grid_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:after
					{
						content: '';
						display: block;
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio01'){ ?>
							/*1:1 ratio*/
							margin-top: 100%;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio02'){ ?>
							/*16:9 ratio*/
							margin-top: 56.25%;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio03'){ ?>
							/*9:16 ratio*/
							margin-top: 177.78%;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio04'){ ?>
							/*3:4 ratio*/
							margin-top: 133.33%;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio05'){ ?>
							/*4:3 ratio*/
							margin-top: 75%;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio06'){ ?>
							/*3:2 ratio*/
							margin-top: 66.67%;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio07'){ ?>
							/*2:3 ratio*/
							margin-top: 150%;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio08'){ ?>
							/*8:5 ratio*/
							margin-top: 62.5%;
						<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio09'){ ?>
							/*5:8 ratio*/
							margin-top: 160%;
						<?php }?>
					}
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 >= '4'){ ?>
						/* Portrait tablet to landscape and desktop */
						@media (min-width: 850px) and (max-width: 979px)
						{
							.TotalSoft_PG_LG_Grid_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?> { width: 33.3%; }
						}
					<?php }?>
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 >= '3'){ ?>
						/* Landscape phone to portrait tablet */
						@media (max-width: 850px)
						{
							.TotalSoft_PG_LG_Grid_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?> { width: 50%; }
						}
					<?php } ?>
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 >= '1'){ ?>
						/* Landscape phones and down */
						@media (max-width: 620px)
						{
							.TotalSoft_PG_LG_Grid_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?> { width: 100%; }
						}
					<?php }?>
					.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?>
					{
						position: absolute;
						top: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04/2;?>px;
						left: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04/2;?>px;
						right: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04/2;?>px;
						bottom: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_04/2;?>px;
						background-size: 100% 100%;
						cursor: pointer;
						transform:none !important;
					}
					.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> img
					{
						width: 100%;
						-webkit-transition: -webkit-transform 0.6s ease;
						transition: -webkit-transform 0.6s ease;
						transition: transform 0.6s ease;
						transition: transform 0.6s ease, -webkit-transform 0.6s ease;
					}
					.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?>.selected<?php echo $Total_Soft_Portfolio;?> { opacity: 0; }
					.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?>.on-top
					{
						cursor: default;
						-webkit-transition: all 0.4s ease;
						transition: all 0.4s ease;
						width:0;
						height:0;
						overflow:hidden !important;
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_28;?>;
					}
					.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?>.show { opacity:1; }
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .content
					{
						position: absolute;
						padding: 20px 40px;
						top: 0;
						right: 0;
						bottom: 0;
						left: 0;
						opacity: 0;
						-webkit-transition: opacity 0.5s ease;
						transition: opacity 0.5s ease;
						overflow-y: auto;
						overflow-x: hidden;
					}
					/* Events List custom webkit scrollbar */
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .content::-webkit-scrollbar {width: 9px;}
					/* Track */
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .content::-webkit-scrollbar-track {background: none;}
					/* Handle */
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .content::-webkit-scrollbar-thumb
					{
						background:<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
						border:1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
						border-radius: 10px;
					}
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .show .content { opacity: 1; }
					@media (max-width: 600px)
					{
						.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .content { padding: 10px 20px; }
					}
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .scroller<?php echo $Total_Soft_Portfolio;?>
					{
						position: fixed;
						top: 0;
						right: 0;
						bottom: 0;
						left: 0;
						z-index: 9999999999;
					}
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .scroller<?php echo $Total_Soft_Portfolio;?> h1
					{
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_27;?>;
						text-transform: none !important;
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_25;?>px;
						letter-spacing: normal !important;
						font-weight:normal !important;
						font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_26;?>;
						cursor: default;
						width: 100%;
						margin-bottom: 30px;
						position: absolute;
						bottom: 50%;
						text-align: center;
						-webkit-animation: up-in 1s ease;
						animation: up-in 1s ease;
					}
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .top-up.ng-hide-add, .TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .top-up.ng-hide-remove
					{
						-webkit-transition: 0s ease top;
						transition: 0s ease top;
					}
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .top-up.ng-hide-add-active, .TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .top-up.ng-hide-remove-active
					{
						-webkit-transition: 0.6s ease top;
						transition: 0.6s ease top;
					}
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .top-up.ng-hide-add { top: 0; }
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .top-up.ng-hide-add.ng-hide-add-active { top: 100%; }
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .top-up.ng-hide-remove { top: 100%; }
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .top-up.ng-hide-remove.ng-hide-remove-active { top: 0; }
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .fullscreen-background
					{
						position: fixed;
						top: 0;
						right: 0;
						bottom: 0;
						left: 0;
						z-index: 999999999;
						background-color: transparent;
						-webkit-transition: top 0.5s ease;
						transition: top 0.5s ease;
						background-repeat: no-repeat;
						background-position: center center;
						background-size: 100% 100%;
					}
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .fullscreen-background.show { top: 0; }
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .close-button
					{
						position: fixed;
						top: 20px;
						right: 20px;
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_31;?>;
						cursor: pointer;
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_30;?>px;
						display:none;
					}
					.TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .close-button:hover { color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_32;?>; }
					.TotalSoft_PG_Anim<?php echo $Total_Soft_Portfolio;?>
					{
						transform: scale(1) translateZ(0) !important;
						-webkit-transform: scale(1) translateZ(0) !important;
						-moz-transform: scale(1) translateZ(0) !important;
					}
					.TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
					{
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20;?>px !important;
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_22;?>;
					}
					.TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>:hover
					{
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
					}
					.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
					{
						margin: 20px 0;
						text-align: center;
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?>;
						position: relative;
						z-index: 0;
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_02 == 'false'){ echo 'display: none';}?>
					}
					.TotalSoft_PG_LG_Button_Div1_<?php echo $Total_Soft_Portfolio;?>
					{
						position: absolute;
						width: 100%;
						height: 100%;
						top: 0;
						left: 0;
						z-index: 1;
						background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?>;
					}
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow01') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 0 10px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 0 10px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 10px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow02') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:after
						{
							bottom: 15px;
							left: 10px;
							width: 50%;
							height: 20%;
							max-width: 300px;
							max-height: 100px;
							-webkit-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-transform: rotate(-3deg);
							-moz-transform: rotate(-3deg);
							-ms-transform: rotate(-3deg);
							-o-transform: rotate(-3deg);
							transform: rotate(-3deg);
							z-index: -1;
							position: absolute;
							content: "";
						}
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:after
						{
							transform: rotate(3deg);
							-moz-transform: rotate(3deg);
							-webkit-transform: rotate(3deg);
							right: 10px;
							left: auto;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow03') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:before
						{
							bottom: 15px;
							left: 10px;
							width: 50%;
							height: 20%;
							max-width: 300px;
							max-height: 100px;
							-webkit-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-transform: rotate(-3deg);
							-moz-transform: rotate(-3deg);
							-ms-transform: rotate(-3deg);
							-o-transform: rotate(-3deg);
							transform: rotate(-3deg);
							z-index: -1;
							position: absolute;
							content: "";
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow04') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:after
						{
							bottom: 15px;
							right: 10px;
							width: 50%;
							height: 20%;
							max-width: 300px;
							max-height: 100px;
							-webkit-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							box-shadow: 0 15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-transform: rotate(3deg);
							-moz-transform: rotate(3deg);
							-ms-transform: rotate(3deg);
							-o-transform: rotate(3deg);
							transform: rotate(3deg);
							z-index: -1;
							position: absolute;
							content: "";
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow05') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:after
						{
							top: 15px;
							left: 10px;
							width: 50%;
							height: 20%;
							max-width: 300px;
							max-height: 100px;
							z-index: -1;
							position: absolute;
							content: "";
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							box-shadow: 0 -15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 0 -15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 -15px 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							transform: rotate(3deg);
							-moz-transform: rotate(3deg);
							-webkit-transform: rotate(3deg);
						}
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:after
						{
							transform: rotate(-3deg);
							-moz-transform: rotate(-3deg);
							-webkit-transform: rotate(-3deg);
							right: 10px;
							left: auto;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow06') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							position:relative;
							box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-webkit-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-moz-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
						}
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:after
						{
							content:"";
							position:absolute;
							z-index:-1;
							box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							top:50%;
							bottom:0;
							left:10px;
							right:10px;
							border-radius:100px / 10px;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow07') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							position:relative;
							box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-webkit-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-moz-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
						}
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:after
						{
							content:"";
							position:absolute;
							z-index:-1;
							box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							top:0;
							bottom:0;
							left:10px;
							right:10px;
							border-radius:100px / 10px;
						}
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:after
						{
							right:10px;
							left:auto;
							transform:skew(8deg) rotate(3deg);
							-moz-transform:skew(8deg) rotate(3deg);
							-webkit-transform:skew(8deg) rotate(3deg);
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow08') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							position:relative;
							box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-webkit-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
							-moz-box-shadow:0 1px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>, 0 0 40px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?> inset;
						}
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:after
						{
							content:"";
							position:absolute;
							z-index:-1;
							box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow:0 0 20px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							top:10px;
							bottom:10px;
							left:0;
							right:0;
							border-radius:100px / 10px;
						}
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:after
						{
							right:10px; 
							left:auto; 
							transform:skew(8deg) rotate(3deg);
							-moz-transform:skew(8deg) rotate(3deg);
							-webkit-transform:skew(8deg) rotate(3deg);
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow09') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 0 0 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 0 0 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 0 10px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow10') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 4px -4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 4px -4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 4px -4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow11') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 5px 5px 3px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 5px 5px 3px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 5px 5px 3px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow12') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 2px 2px white, 4px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 2px 2px white, 4px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 2px 2px white, 4px 4px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow13') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 8px 8px 18px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 8px 8px 18px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 8px 8px 18px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow14') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 0 8px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 8px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 0 8px 6px -6px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow15') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 0 0 18px 7px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-moz-box-shadow: 0 0 18px 7px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
							-webkit-box-shadow: 0 0 18px 7px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_13;?>;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_12 == 'shadow00') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: none !important;
							-moz-box-shadow: none !important;
							-webkit-box-shadow: none !important;
						}
					<?php } ?>
					.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>
					{
						display: inline-block;
						padding: 5px 10px !important;
						margin:0 !important;
						border-radius:0 !important;
						background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05;?>;
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>;
						font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?>;
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?>px;
						cursor: pointer;
						position: relative !important;
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 != 'effect01') { ?> z-index: 2; <?php } ?>
						text-transform: none !important;
						border: none !important;
						height: inherit;
						line-height: 1 !important;
						overflow: visible !important;
						transition: background-color 0s;
						-webkit-transition: background-color 0s;
						-moz-transition: background-color 0s;
					}
					.TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>
					{
						font-weight: 400 !important;
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_08;?> !important;
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07;?>px !important;
						padding: 0 !important;
						<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 != 'effect04' && $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 != 'effect05' && $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 != 'effect06') { ?> line-height: 1 !important; <?php } ?>
					}
					.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:active
					{
						padding: 5px 10px !important;
						border: none !important;
					}
					.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:active, .TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover, .TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:focus
					{
						background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
						outline: none !important;
						opacity: 1 !important;
					}
					.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?> span
					{
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
					}
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect01') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>:after, .TotalSoft_PG_LG_Button_Div1_<?php echo $Total_Soft_Portfolio;?>
						{
							display: none;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?> { margin: 10px 0 !important; }
						.TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?> { padding: 5px 10px 5px 30px !important; }
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:active { padding: 5px 10px 5px 30px !important; }
						.TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>:after, .TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover:after
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:after {
							content: '';
							position: absolute;
							top: 0;
							right: -<?php echo ($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07+10)/2;?>px;
							width: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07+10;?>px;
							height: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_07+10;?>px;
							transform: scale(0.707) rotate(45deg);
							z-index: 1;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_05;?>;
							box-shadow:
								2px -2px 0 2px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>,
								3px -3px 0 2px <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							border-radius: 0 5px 0 50px;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:last-child:after { content: none; }
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect02') { ?>
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>
						{
							margin: 10px 0 !important;
							transform: skew(-25deg);
							-moz-transform: skew(-25deg);
							-webkit-transform: skew(-25deg);
						}
						.TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
						}
						.TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>
						{
							display: block;
							transform: skew(25deg);
							-moz-transform: skew(25deg);
							-webkit-transform: skew(25deg);
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect03') { ?>
						.TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Button_Div1_<?php echo $Total_Soft_Portfolio;?>
						{
							background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?> 25%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?> 75%, rgba(255, 255, 255, 0) 100%);
							background: -o-linear-gradient(right, rgba(255, 255, 255, 0) 0%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?> 25%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?> 75%, rgba(255, 255, 255, 0) 100%);
							background: -moz-linear-gradient(right, rgba(255, 255, 255, 0) 0%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?> 25%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?> 75%, rgba(255, 255, 255, 0) 100%);
							background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?> 25%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?> 75%, rgba(255, 255, 255, 0) 100%);
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?> { margin: 10px 0 !important; }
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover, .TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>
						{
							box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), inset 0 0 1px rgba(255, 255, 255, 0.6);
							-moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), inset 0 0 1px rgba(255, 255, 255, 0.6);
							-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), inset 0 0 1px rgba(255, 255, 255, 0.6);
						}
						.TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect04' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect05' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect06') { ?>
						.TotalSoft_PG_LG_Button_Div2_<?php echo $Total_Soft_Portfolio;?> { margin: 10px 0 !important; z-index: 3; }
						.TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						}
						.TotalSoft_PG_LG_Button_Div2_<?php echo $Total_Soft_Portfolio;?>
						{
							position: relative;
							overflow: hidden;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>;
							transition: 0.5s;
							display: inline-block;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>
						{
							width: 101%;
							height: 100%;
							border: none;
							cursor: pointer;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect04'){ ?>
								-webkit-mask: url("<?php echo plugins_url('../Images/Sprite/nature-sprite.png',__FILE__);?>");
								mask: url("<?php echo plugins_url('../Images/Sprite/nature-sprite.png',__FILE__);?>");
								-webkit-mask-size: 2300% 100%;
								mask-size: 2300% 100%;
								-webkit-animation: ani2 0.7s steps(22) forwards;
								animation: ani2 0.7s steps(22) forwards;
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect05'){ ?>
								-webkit-mask: url("<?php echo plugins_url('../Images/Sprite/nature-sprite-2.png',__FILE__);?>");
								mask: url("<?php echo plugins_url('../Images/Sprite/nature-sprite-2.png',__FILE__);?>");
								-webkit-mask-size: 7100% 100%;
								mask-size: 7100% 100%;
								-webkit-animation: ani2 0.7s steps(70) forwards;
								animation: ani2 0.7s steps(70) forwards;
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect06'){ ?>
								-webkit-mask: url("<?php echo plugins_url('../Images/Sprite/urban-sprite.png',__FILE__);?>");
								mask: url("<?php echo plugins_url('../Images/Sprite/urban-sprite.png',__FILE__);?>");
								-webkit-mask-size: 3000% 100%;
								mask-size: 3000% 100%;
								-webkit-animation: ani2 0.7s steps(29) forwards;
								animation: ani2 0.7s steps(29) forwards;
							<?php }?>
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect04'){ ?>
								-webkit-animation: ani 0.7s steps(22) forwards;
								animation: ani 0.7s steps(22) forwards;
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect05'){ ?>
								-webkit-animation: ani 0.7s steps(70) forwards;
								animation: ani 0.7s steps(70) forwards;
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect06'){ ?>
								-webkit-animation: ani 0.7s steps(29) forwards;
								animation: ani 0.7s steps(29) forwards;
							<?php }?>
						}
						.TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							text-align: center;
							width: 101%;
							position: absolute;
							overflow: hidden;
						}
						@-webkit-keyframes ani
						{
							from { -webkit-mask-position: 0 0; mask-position: 0 0; color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important; }
							to { -webkit-mask-position: 100% 0; mask-position: 100% 0; }
						}
						@keyframes ani
						{
							from { -webkit-mask-position: 0 0; mask-position: 0 0; color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important; }
							to { -webkit-mask-position: 100% 0; mask-position: 100% 0; }
						}
						@-webkit-keyframes ani2 { from { -webkit-mask-position: 100% 0; mask-position: 100% 0; } to { -webkit-mask-position: 0 0; mask-position: 0 0; } }
						@keyframes ani2 { from { -webkit-mask-position: 100% 0; mask-position: 100% 0; } to { -webkit-mask-position: 0 0; mask-position: 0 0; } }
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect07') { ?>
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?> { margin: 10px 0 !important; }
						.TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:before
						{
							pointer-events: none;
							position: absolute;
							content: '';
							height: 0;
							width: 0;
							bottom: 0;
							left: 0;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?>;
							background: linear-gradient(45deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?> 45%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> 50%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> 56%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_03;?> 80%);
							box-shadow: 1px -1px 1px rgba(0, 0, 0, 0.4);
							-moz-box-shadow: 1px -1px 1px rgba(0, 0, 0, 0.4);
							-webkit-box-shadow: 1px -1px 1px rgba(0, 0, 0, 0.4);
							transition-duration: 0.3s;
							transition-property: width height;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover:before, .TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>:before
						{
							width: 10px;
							height: 10px;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect08') { ?>
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?> { margin: 10px 0 !important; }
						.TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:before
						{
							pointer-events: none;
							position: absolute;
							opacity: 0;
							content: '';
							border-style: solid;
							transition-duration: 0.3s;
							transition-property: bottom opacity;
							left: calc(50% - 7px);
							bottom: 0;
							border-width: 7px 7px 0 7px;
							border-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> transparent transparent transparent;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover:before, .TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>:before
						{
							bottom: -7px;
							opacity: 1;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect09') { ?>
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?> { margin: 10px 0 !important; overflow: hidden !important; }
						.TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?> span
						{
							color: rgba(0,0,0,0) !important;
							text-shadow: 0 45px 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>, 0 0 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>;
						}
						.TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>
						{
							color: rgba(0,0,0,0) !important;
							text-shadow:0 0 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>, 0 -45px 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>;
							transition: all .3s ease;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect10') { ?>
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?> { margin: 10px 0 !important; overflow: hidden !important; padding: 10px 15px; }
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:active { padding: 10px 15px !important; }
						.TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?> span
						{
							color: rgba(0,0,0,0) !important;
							text-shadow:0 0 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?>, -200px 0 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>, 200px 0 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>, 0 45px 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?> , 0 -45px 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?> ;
						}
						.TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>
						{
							color: rgba(0,0,0,0) !important;
							text-shadow:0 0 0 <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?>;
							transition: all .5s ease;
						}
					<?php } else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect11') { ?>
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>
						{
							margin: 10px 0 !important;
							overflow: hidden !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_06;?> !important;
							transition: 0.5s background;
							-moz-transition: 0.5s background;
							-webkit-transition: 0.5s background;
						}
						.TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_10;?> !important;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_11;?> !important;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:after
						{
							background: #fff;
							content: "";
							height: 155px;
							left: -75px;
							opacity: .2;
							position: absolute;
							top: -50px;
							-webkit-transform: rotate(35deg);
							transform: rotate(35deg);
							-webkit-transition: all 550ms cubic-bezier(0.19, 1, 0.22, 1);
							transition: all 550ms cubic-bezier(0.19, 1, 0.22, 1);
							width: 50px;
						}
						.TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>:hover:after
						{
							left: 120%;
							-webkit-transition: all 550ms cubic-bezier(0.19, 1, 0.22, 1);
							transition: all 550ms cubic-bezier(0.19, 1, 0.22, 1);
						}
					<?php } ?>
					<?php if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect01' ){ ?>
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?> { position: relative; overflow: hidden; text-align: center; }
						.TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							display: inline-block;
							padding: 6px 16px;
							position: absolute;
							bottom: 0px;
							left: 0px;
							opacity: 0;
							z-index: 1;
							-webkit-transition: 0.05s linear;
							-moz-transition: 0.05s linear;
							transition: 0.05s linear;
							-webkit-transition-delay: 0.01s;
							-moz-transition-delay: 0.01s;
							transition-delay: 0.01s;
						}
						.TotalSoft_PG_LG_Box_Curl_<?php echo $Total_Soft_Portfolio;?>
						{
							width: 0px;
							height: 0px;
							position: absolute;
							bottom: 0px;
							left: 0px;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio01'){ ?>
								/*1:1 ratio*/
								background: linear-gradient(225deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 38%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 44%, #888888 50%, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.4) 60%, rgba(0, 0, 0, 0.3));
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio02'){ ?>
								/*16:9 ratio*/
								background: linear-gradient(209deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 38%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 44%, #888888 50%, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.4) 60%, rgba(0, 0, 0, 0.3));
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio03'){ ?>
								/*9:16 ratio*/
								background: linear-gradient(241deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 38%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 44%, #888888 50%, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.4) 60%, rgba(0, 0, 0, 0.3));
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio04'){ ?>
								/*3:4 ratio*/
								background: linear-gradient(234deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 38%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 44%, #888888 50%, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.4) 60%, rgba(0, 0, 0, 0.3));
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio05'){ ?>
								/*4:3 ratio*/
								background: linear-gradient(217deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 38%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 44%, #888888 50%, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.4) 60%, rgba(0, 0, 0, 0.3));
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio06'){ ?>
								/*3:2 ratio*/
								background: linear-gradient(213deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 38%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 44%, #888888 50%, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.4) 60%, rgba(0, 0, 0, 0.3));
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio07'){ ?>
								/*2:3 ratio*/
								background: linear-gradient(237deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 38%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 44%, #888888 50%, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.4) 60%, rgba(0, 0, 0, 0.3));
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio08'){ ?>
								/*8:5 ratio*/
								background: linear-gradient(212deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 38%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 44%, #888888 50%, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.4) 60%, rgba(0, 0, 0, 0.3));
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio09'){ ?>
								/*5:8 ratio*/
								background: linear-gradient(238deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?> 20%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 38%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?> 44%, #888888 50%, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.4) 60%, rgba(0, 0, 0, 0.3));
							<?php }?>
							transition: all .4s ease;
							-moz-transition: all .4s ease;
							-webkit-transition: all .4s ease;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							opacity: 1;
							-webkit-transition-delay: 0.15s;
							-moz-transition-delay: 0.15s;
							transition-delay: 0.15s;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Curl_<?php echo $Total_Soft_Portfolio;?>
						{
							width: 50%;
							height: 50%;
						}
					<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect02' ){ ?>
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?> *
						{
							-webkit-transition: all 0.35s ease-out;
							-moz-transition: all 0.35s ease-out;
							transition: all 0.35s ease-out;
						}
						.TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							right: 0px;
							bottom: 0px;
							width: 50px;
							height: 50px;
							line-height: 50px;
							z-index: 1;
							text-align: center;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							top: 0px;
							left: 0px;
							right: 0px;
							bottom: 0px;
							overflow: hidden;
						}
						.TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							top: 0;
							left: 0;
							<?php if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 > 3 ){ ?>
								padding: 5px;
							<?php }else{ ?>
								padding: 20px;
							<?php }?>
							z-index: 1;
							max-width: 250px;
							opacity: 0;
							-webkit-transform: translate(-20px, -20px);
							-moz-transform: translate(-20px, -20px);
							transform: translate(-20px, -20px);
						}
						.TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							width: 50px;
							height: 50px;
							position: absolute;
							top: -80px;
							left: 15px;
							border-radius: 50%;
							-webkit-transition: all 0.35s ease;
							-moz-transition: all 0.35s ease;
							transition: all 0.35s ease;
							z-index: 1;
						}
						.TotalSoft_PG_LG_Box_Hover2_<?php echo $Total_Soft_Portfolio;?>
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>;
							width: 50px;
							height: 50px;
							position: absolute;
							right: 15px;
							bottom: 15px;
							border-radius: 50%;
							-webkit-transition: all 0.35s ease;
							-moz-transition: all 0.35s ease;
							transition: all 0.35s ease;
							<?php if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 > 3 ){ ?>
								-webkit-transform: scale(0.7);
								-moz-transform: scale(0.7);
								transform: scale(0.7);
								right: 5px;
								bottom: 5px;
							<?php }?>
						}
						.TotalSoft_PG_LG_Box_Hover2_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>;
						}
						.TotalSoft_PG_LG_Box_Hover2_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_24;?>;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>
						{
							<?php if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 == '1' ){ ?>
								-webkit-transform: scale(10);
								-moz-transform: scale(10);
								transform: scale(10);
							<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 == '2' ){ ?>
								-webkit-transform: scale(8);
								-moz-transform: scale(8);
								transform: scale(8);
							<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 == '3' ){ ?>
								-webkit-transform: scale(6);
								-moz-transform: scale(6);
								transform: scale(6);
							<?php }else{ ?>
								-webkit-transform: scale(5);
								-moz-transform: scale(5);
								transform: scale(5);
							<?php }?>
							-webkit-transition-delay: 0.15s;
							-moz-transition-delay: 0.15s;
							transition-delay: 0.15s;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover2_<?php echo $Total_Soft_Portfolio;?>
						{
							<?php if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 == '1' ){ ?>
								-webkit-transform: scale(5);
								-moz-transform: scale(5);
								transform: scale(5);
							<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 == '2' ){ ?>
								-webkit-transform: scale(4);
								-moz-transform: scale(4);
								transform: scale(4);
							<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 == '3' ){ ?>
								-webkit-transform: scale(2);
								-moz-transform: scale(2);
								transform: scale(2);
							<?php }?>
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							<?php if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_14 < 3 ){ ?>
								-webkit-transform: scale(0.5) translate(-10px, -10px);
								-moz-transform: scale(0.5) translate(-10px, -10px);
								transform: scale(0.5) translate(-10px, -10px);
							<?php }?>
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
						{
							-webkit-transform: translate(0, 0);
							-moz-transform: translate(0, 0);
							transform: translate(0, 0);
							opacity: 1;
							-webkit-transition-delay: 0.15s;
							-moz-transition-delay: 0.15s;
							transition-delay: 0.15s;
						}
					<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect03' ){ ?>
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?> { overflow: hidden; }
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
							overflow: hidden;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before
						{
							height: 100%;
							width: 100%;
							top: 0;
							right: -50%;
							content: '';
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
							position: absolute;
							-webkit-transition: all 0.3s ease-in-out;
							-moz-transition: all 0.3s ease-in-out;
							transition: all 0.3s ease-in-out;
							z-index: 2;
							transform: skew(-20deg) translateX(0%);
							-moz-transform: skew(-20deg) translateX(0%);
							-webkit-transform: skew(-20deg) translateX(0%);
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before
						{
							-webkit-transform: skew(-20deg) translateX(150%);
							-moz-transform: skew(-20deg) translateX(150%);
							transform: skew(-20deg) translateX(150%);
						}
						.TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							left: 40px;
							right: 40px;
							display: inline-block;
							-webkit-transform: skew(-10deg) rotate(-10deg) translate(0, -50%);
							-moz-transform: skew(-10deg) rotate(-10deg) translate(0, -50%);
							transform: skew(-10deg) rotate(-10deg) translate(0, -50%);
							padding: 12px 5px;
							margin: 0;
							text-align: center;
							top: 50%;
							z-index: 3;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							-webkit-transition: all 0.3s ease-in-out;
							-moz-transition: all 0.3s ease-in-out;
							transition: all 0.3s ease-in-out;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
						{
							-webkit-transform: skew(-10deg) rotate(-10deg) translate(-150%, -50%);
							-moz-transform: skew(-10deg) rotate(-10deg) translate(-150%, -50%);
							transform: skew(-10deg) rotate(-10deg) translate(-150%, -50%);
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?>
						{
							-webkit-transform: scale(1);
							-moz-transform: scale(1);
							transform: scale(1);
							-webkit-transition: all 0.3s ease-in-out;
							-moz-transition: all 0.3s ease-in-out;
							transition: all 0.3s ease-in-out;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?>
						{
							background-size: 105% 105%;
						}
					<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect04' ){ ?>
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?> { overflow: hidden; }
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?> *
						{
							-webkit-transition: all 0.6s ease;
							-moz-transition: all 0.6s ease;
							transition: all 0.6s ease;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
							overflow: hidden;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
							width: 100%;
							height: 100%;
							position: absolute;
							left: 0;
							bottom: 0;
							content: '';
							-webkit-transform: skew(-45deg) scaleX(0);
							-moz-transform: skew(-45deg) scaleX(0);
							transform: skew(-45deg) scaleX(0);
							-webkit-transition: all 0.3s ease-in-out;
							-moz-transition: all 0.3s ease-in-out;
							transition: all 0.3s ease-in-out;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before
						{
							-webkit-transform: skew(-45deg) scaleX(1);
							-moz-transform: skew(-45deg) scaleX(1);
							transform: skew(-45deg) scaleX(1);
							-webkit-transition: all 400ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
							-moz-transition: all 400ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
							transition: all 400ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
						}
						.TotalSoft_PG_LG_Box_Icon_Span_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							top: 50%;
							left: 0;
							width: 100%;
							-webkit-transform: translateY(-50%);
							-moz-transform: translateY(-50%);
							transform: translateY(-50%);
							z-index: 1;
							text-align: center;
						}
						.TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
						{
							margin: 0;
							width: 100%;
							display: block;
						}
						.TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?> { opacity: 0; }
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							-webkit-transform: translate3d(0%, 0%, 0);
							-moz-transform: translate3d(0%, 0%, 0);
							transform: translate3d(0%, 0%, 0);
							-webkit-transition-delay: 0.2s;
							-moz-transition-delay: 0.2s;
							transition-delay: 0.2s;
							opacity: 1;
						}
					<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect05' ){ ?>
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?> *
						{
							-webkit-transition: all 0.2s ease-in;
							-moz-transition: all 0.2s ease-in;
							transition: all 0.2s ease-in;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							top: 0;
							bottom: 0;
							right: 0;
							left: 0;
							z-index: 1;
							display: block;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
						}
						.TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>:after
						{
							width: 2px;
							height: 0%;
						}
						.TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>:before { right: 0; top: 0; }
						.TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>:after { left: 0; bottom: 0; }
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:after, .TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>:after
						{
							position: absolute;
							content: '';
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							z-index: 1;
							-webkit-transition: all 0.4s ease-in;
							-moz-transition: all 0.4s ease-in;
							transition: all 0.4s ease-in;
							opacity: 1;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:after
						{
							height: 2px;
							width: 0%;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before { top: 0; left: 0; }
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:after { bottom: 0; right: 0; }
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>:after
						{
							height: 100%;
							opacity: 0.1;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before,	.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:after
						{
							width: 100%;
							opacity: 0.1;
						}
						.TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							bottom: 15px;
							right: 15px;
							-webkit-transform: rotate(-45deg);
							-moz-transform: rotate(-45deg);
							transform: rotate(-45deg);
							opacity: 0;
							z-index: 10;
							-webkit-transition: all 0.4s cubic-bezier(0.6, -0.8, 0.735, 0.045);
							-moz-transition: all 0.4s cubic-bezier(0.6, -0.8, 0.735, 0.045);
							transition: all 0.4s cubic-bezier(0.6, -0.8, 0.735, 0.045);
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							-webkit-transform: rotate(0deg);
							-moz-transform: rotate(0deg);
							transform: rotate(0deg);
							opacity: 1;
						}
					<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect06' ){ ?>
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							top: 0;
							bottom: 0;
							right: 0;
							left: 0;
							z-index: 1;
							display: block;
							overflow: hidden;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before
						{
							position: absolute;
							top: 0px;
							left: 0px;
							width: 0%;
							height: 100%;
							border-top: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							content: '';
							transform-origin: 0% 0%;
							-moz-transform-origin: 0% 0%;
							-webkit-transform-origin: 0% 0%;
							opacity: 0;
							<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio01'){ ?>
								/*1:1 ratio*/
								transform: rotate3d(0,0,1,44.9deg);
								-moz-transform: rotate3d(0,0,1,44.9deg);
								-webkit-transform: rotate3d(0,0,1,44.9deg);
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio02'){ ?>
								/*16:9 ratio*/
								transform: rotate3d(0,0,1,28.9deg);
								-moz-transform: rotate3d(0,0,1,28.9deg);
								-webkit-transform: rotate3d(0,0,1,28.9deg);
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio03'){ ?>
								/*9:16 ratio*/
								transform: rotate3d(0,0,1,60.9deg);
								-moz-transform: rotate3d(0,0,1,60.9deg);
								-webkit-transform: rotate3d(0,0,1,60.9deg);
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio04'){ ?>
								/*3:4 ratio*/
								transform: rotate3d(0,0,1,53.3deg);
								-moz-transform: rotate3d(0,0,1,53.3deg);
								-webkit-transform: rotate3d(0,0,1,53.3deg);
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio05'){ ?>
								/*4:3 ratio*/
								transform: rotate3d(0,0,1,36.5deg);
								-moz-transform: rotate3d(0,0,1,36.5deg);
								-webkit-transform: rotate3d(0,0,1,36.5deg);
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio06'){ ?>
								/*3:2 ratio*/
								transform: rotate3d(0,0,1,33.2deg);
								-moz-transform: rotate3d(0,0,1,33.2deg);
								-webkit-transform: rotate3d(0,0,1,33.2deg);
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio07'){ ?>
								/*2:3 ratio*/
								transform: rotate3d(0,0,1,56.5deg);
								-moz-transform: rotate3d(0,0,1,56.5deg);
								-webkit-transform: rotate3d(0,0,1,56.5deg);
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio08'){ ?>
								/*8:5 ratio*/
								transform: rotate3d(0,0,1,31.5deg);
								-moz-transform: rotate3d(0,0,1,31.5deg);
								-webkit-transform: rotate3d(0,0,1,31.5deg);
							<?php }else if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_15 == 'ratio09'){ ?>
								/*5:8 ratio*/
								transform: rotate3d(0,0,1,58.2deg);
								-moz-transform: rotate3d(0,0,1,58.2deg);
								-webkit-transform: rotate3d(0,0,1,58.2deg);
							<?php }?>
							transition: width 1.8s;
							-moz-transition: width 1.8s;
							-webkit-transition: width 1.8s;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before
						{
							opacity: 1;
							width: 400%;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> { overflow: hidden; }
						.TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							top: 50%;
							left: 50%;
							z-index: 10;
							transform: translate(-50%, -500%);
							-moz-transform: translate(-50%, -500%);
							-webkit-transform: translate(-50%, -500%);
							opacity: 0;
							transition: all 0.8s;
							-moz-transition: all 0.8s;
							-webkit-transition: all 0.8s;
							transition-delay: 0.3s;
							-moz-transition-delay: 0.3s;
							-webkit-transition-delay: 0.3s;
							padding: 10px 10px;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>;
							border-radius: 50%;
						}
						.TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							opacity: 1;
							transform: translate(-50%, -50%);
							-moz-transform: translate(-50%, -50%);
							-webkit-transform: translate(-50%, -50%);
						}
					<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect07' ){ ?>
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> { overflow: hidden; }
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:after
						{
							position: absolute;
							top: 0;
							bottom: 0;
							left: 0;
							right: 0;
							-webkit-transition: all 0.35s ease;
							-moz-transition: all 0.35s ease;
							transition: all 0.35s ease;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
							border-left: 3px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?>;
							border-right: 3px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?>;
							content: '';
							z-index: 1;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before
						{
							-webkit-transform: skew(45deg) translateX(-155%);
							-moz-transform: skew(45deg) translateX(-155%);
							transform: skew(45deg) translateX(-155%);
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:after
						{
							-webkit-transform: skew(45deg) translateX(155%);
							-moz-transform: skew(45deg) translateX(155%);
							transform: skew(45deg) translateX(155%);
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before
						{
							-webkit-transform: skew(45deg) translateX(-55%);
							-moz-transform: skew(45deg) translateX(-55%);
							transform: skew(45deg) translateX(-55%);
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:after
						{
							-webkit-transform: skew(45deg) translateX(55%);
							-moz-transform: skew(45deg) translateX(55%);
							transform: skew(45deg) translateX(55%);
						}
						.TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
						{
							top: 50%;
							left: 50%;
							position: absolute;
							z-index: 2;
							-webkit-transform: translate(-50%, -50%) scale(0.5);
							-moz-transform: translate(-50%, -50%) scale(0.5);
							transform: translate(-50%, -50%) scale(0.5);
							opacity: 0;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							border: 2px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?>;
							margin: 0;
							padding: 5px 10px;
							-webkit-transition: transform 0.35s ease;
							-moz-transition: transform 0.35s ease;
							transition: transform 0.35s ease;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
						{
							-webkit-transform: translate(-50%, -50%) scale(1);
							-moz-transform: translate(-50%, -50%) scale(1);
							transform: translate(-50%, -50%) scale(1);
							opacity: 1;
						}
					<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect08' ){ ?>
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							bottom: 0;
							left: 0;
							width: 100%;
							height: 100%;
							-webkit-transition: background 0.4s;
							-moz-transition: background 0.4s;
							transition: background 0.4s;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>::before
						{
							position: absolute;
							top: 50%;
							right: 0;
							left: 100%;
							height: 2px;
							content: '';
							opacity: 0;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							-webkit-transition: all 0.4s;
							-moz-transition: all 0.4s;
							transition: all 0.4s;
							-webkit-transition-delay: 0.6s;
							-moz-transition-delay: 0.6s;
							transition-delay: 0.6s;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>::before
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							left: 30px;
							opacity: 1;
							-webkit-transition-delay: 0s;
							-moz-transition-delay: 0s;
							transition-delay: 0s;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?> > div
						{
							height: 50%;
							overflow: hidden;
							width: 100%;
							position: relative;
						}
						.TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							width: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20+10;?>px;
							height: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20+10;?>px;
							line-height: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20+10;?>px;
							text-align: center;
							position: absolute;
							display: block;
							bottom: 0;
							left: 30px;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>;
							-webkit-transform: translate3d(0%, 50%, 0);
							-moz-transform: translate3d(0%, 50%, 0);
							transform: translate3d(0%, 50%, 0);
							-webkit-transition-delay: 0s;
							-moz-transition-delay: 0s;
							transition-delay: 0s;
							margin: 0;
							opacity: 0;
							-webkit-transition: all 0.4s;
							-moz-transition: all 0.4s;
							transition: all 0.4s;
						}
						.TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>;
						}
						.TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
						{
							padding: 5px 35px;
							position: absolute;
							-webkit-transform: translate3d(0%, -50%, 0);
							-moz-transform: translate3d(0%, -50%, 0);
							transform: translate3d(0%, -50%, 0);
							-webkit-transition-delay: 0s;
							-moz-transition-delay: 0s;
							transition-delay: 0s;
							margin: 0;
							opacity: 0;
							-webkit-transition: all 0.4s;
							-moz-transition: all 0.4s;
							transition: all 0.4s;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>, .TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
						{
							-webkit-transform: translate3d(0%, 0%, 0);
							-moz-transform: translate3d(0%, 0%, 0);
							transform: translate3d(0%, 0%, 0);
							-webkit-transition-delay: 0.3s;
							-moz-transition-delay: 0.3s;
							transition-delay: 0.3s;
							opacity: 1;
						}
					<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect09' ){ ?>
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							bottom: 0;
							left: 0;
							width: 100%;
							height: 100%;
							-webkit-transition: background 0.4s;
							-moz-transition: background 0.4s;
							transition: background 0.4s;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
						}
						.TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							border-radius: 5px;
							display: block;
							position: absolute;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_21;?>;
							top: 50%;
							left: 50%;
							height: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20+20;?>px;
							width: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20+20;?>px;
							line-height: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_20+20;?>px;
							opacity: 0;
							text-align: center;
							-webkit-transform: translate(-50%, -50%) rotate(0deg);
							-moz-transform: translate(-50%, -50%) rotate(0deg);
							transform: translate(-50%, -50%) rotate(0deg);
							-webkit-transition: all 0.35s;
							-moz-transition: all 0.35s;
							transition: all 0.35s;
							-webkit-transition-delay: 0.3s;
							-moz-transition-delay: 0.3s;
							transition-delay: 0.3s;
						}
						.TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>:hover
						{
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_23;?>;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?>
						{
							opacity: 1;
							-webkit-transform: translate(-50%, -50%) rotate(45deg);
							-moz-transform: translate(-50%, -50%) rotate(45deg);
							transform: translate(-50%, -50%) rotate(45deg);
						}
					<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect10' ){ ?>
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							position: absolute;
							bottom: 0;
							left: 0;
							width: 100%;
							height: 100%;
							-webkit-transition: background 0.4s;
							-moz-transition: background 0.4s;
							transition: background 0.4s;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_17;?>;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before, .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:after
						{
							position: absolute;
							top: 15px;
							right: 15px;
							bottom: 15px;
							left: 15px;
							content: '';
							opacity: 0;
							-webkit-transition: opacity 0.8s, -webkit-transform 0.8s;
							-moz-transition: opacity 0.8s, -moz-transform 0.8s;
							transition: opacity 0.8s, transform 0.8s;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before
						{
							border-top: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							border-bottom: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							-webkit-transform: scale(0, 1);
							-moz-transform: scale(0, 1);
							transform: scale(0, 1);
							opacity: 0;
						}
						.TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:after
						{
							border-left: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							border-right: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
							-webkit-transform: scale(1, 0);
							-moz-transform: scale(1, 0);
							transform: scale(1, 0);
							opacity: 0;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:before
						{
							opacity: 1;
							-webkit-transform: scale(1);
							-moz-transform: scale(1);
							transform: scale(1);
							border-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>:after
						{
							opacity: 1;
							-webkit-transform: scale(1);
							-moz-transform: scale(1);
							transform: scale(1);
							border-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_18;?>;
						}
						.TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
						{
							z-index: 11;
							position: absolute;
							left: 15px;
							right: 15px;
							text-align: center;
							padding: 0 5px;
							top: 50%;
							transform: translateY(-50%);
							-moz-transform: translateY(-50%);
							-webkit-transform: translateY(-50%);
							opacity: 0;
							-webkit-transition: opacity 0.8s;
							-moz-transition: opacity 0.8s;
							transition: opacity 0.8s;
						}
						.TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>:hover .TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
						{
							opacity: 1;
						}
					<?php }?>
					.TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>
					{
						font-size: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_06;?>px;
						font-family: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_07;?>;
						color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_08;?>;
					}
					.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk
					{
						font-size: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_33;?>px;
						font-family: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_34;?>;
						color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?>;
						padding: 8px 10px;
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05 == 'full'){ ?>
							display: block;
							width: 100%;
							text-align: center;
						<?php }?>
					}
					.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk_Span
					{
						display: block;
						width: 100%;
						height: inherit;
						<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05 != 'full'){ ?>
							text-align: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05;?>;
						<?php }?>
					}
					.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk, .TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:focus, .TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover
					{
						text-decoration: none;
						outline: none;
						box-shadow: none;
						-webkit-box-shadow: none;
						-moz-box-shadow: none;
						border-bottom: none;
					}
					<?php if( $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01 == 'style01' ){ ?>
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?>;
							border-image: linear-gradient(to right, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?> 15%, rgba(0, 0, 0, 0) 30%, rgba(0, 0, 0, 0) 70%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?> 85%) 1;
							transition: all .2s;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover
						{
							background: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
							color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
							transition: all .2s;
							-moz-transition: all .2s;
							-webkit-transition: all .2s;
							border: 1px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:focus
						{
							border: 1px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk .TotalSoft_PG_LG_LInk_S { display: none; }
					<?php }else if( $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01 == 'style02' ){ ?>
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk
						{
							margin: 0 auto;
							margin-bottom: 0;
							display: inline-block;
							overflow: hidden;
							position: relative;
							-webkit-transform: translateZ(0);
							-moz-transform: translateZ(0);
							transform: translateZ(0);
							border: 2px solid <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_35;?>;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>;
							-webkit-transition: all 0.2s ease-out 0s;
							-moz-transition: all 0.2s ease-out 0s;
							transition: all 0.2s ease-out 0s;
							padding: 8px 15px;
							border-radius: 15px;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk .TotalSoft_PG_LG_LInk_S
						{
							display: block;
							position: absolute;
							top: 0;
							right: 0;
							width: 300%;
							height: 100%;
							bottom: auto;
							margin: auto;
							z-index: -1;
							background: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
							background: -moz-linear-gradient(90deg, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 0%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 94%, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 100%);
							background: -webkit-gradient(linear, left bottom, right top, color-stop(0%, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>), color-stop(94%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>), color-stop(100%, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>));
							background: -webkit-linear-gradient(90deg, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 0%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 94%, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 100%);
							background: -o-linear-gradient(90deg, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 0%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 94%, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 100%);
							background: -ms-linear-gradient(90deg, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 0%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 94%, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 100%);
							background: linear-gradient(90deg, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 0%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 94%, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 100%);
							filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>', endColorstr='<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>',GradientType=1 );
							-webkit-transition: all 0s ease-out 0s;
							-moz-transition: all 0s ease-out 0s;
							transition: all 0s ease-out 0s;
							-webkit-transform: translateX(-35%);
							-moz-transform: translateX(-35%);
							transform: translateX(-35%);
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover
						{
							border: 2px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
							color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
							-webkit-transition: all 0.3s ease-out 0.1s;
							-moz-transition: all 0.3s ease-out 0.1s;
							transition: all 0.3s ease-out 0.1s;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover .TotalSoft_PG_LG_LInk_S
						{
							-webkit-transform: translateX(101%);
							-moz-transform: translateX(101%);
							transform: translateX(101%);
							-webkit-transition: all 0.8s ease-out 0s;
							-moz-transition: all 0.8s ease-out 0s;
							transition: all 0.8s ease-out 0s;
						}
					<?php }else if( $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01 == 'style03' ){ ?>
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk
						{
							cursor: pointer;
							display: inline-block;
							text-align: center;
							overflow: hidden;
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:before
						{
							transition: all .4s ease-out;
							-moz-transition: all .4s ease-out;
							-webkit-transition: all .4s ease-out;
							float:left;
							margin-left: -20px;
							margin-top: -20px;
							width:10px;
							height:10px;
							display: block;
							background: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
							content: "";
							box-shadow: 30px 30px 0px -10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
							-moz-box-shadow: 30px 30px 0px -10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
							-webkit-box-shadow: 30px 30px 0px -10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover:before
						{
							box-shadow: 30px 30px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 80px 10px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 20px 80px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 100px 60px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 65px 45px 0px 5px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 60px 70px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 130px 10px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 140px 50px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 145px 85px 0px 15px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 185px 75px 0px 15px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 165px 15px 0px 5px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 170px 40px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 160px 60px 0px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 195px 45px 0px 5px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 190px 10px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 190px 30px 0px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 200px 30px 0px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
							-moz-box-shadow: 30px 30px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 80px 10px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 20px 80px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 100px 60px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 65px 45px 0px 5px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 60px 70px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 130px 10px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 140px 50px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 145px 85px 0px 15px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 185px 75px 0px 15px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 165px 15px 0px 5px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 170px 40px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 160px 60px 0px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 195px 45px 0px 5px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 190px 10px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 190px 30px 0px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 200px 30px 0px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
							-webkit-box-shadow: 30px 30px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 80px 10px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 20px 80px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 100px 60px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 65px 45px 0px 5px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 60px 70px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 130px 10px 0px 20px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 140px 50px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 145px 85px 0px 15px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 185px 75px 0px 15px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 165px 15px 0px 5px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 170px 40px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 160px 60px 0px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 195px 45px 0px 5px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 190px 10px 0px 10px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 190px 30px 0px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>, 200px 30px 0px <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
						}
						.TotalSoft_PG_LG_LInk_S { display: none; }
					<?php }else if( $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01 == 'style04' ){ ?>
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk
						{
							background: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>;
							background: -moz-linear-gradient(-45deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 0%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 40%, <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 50%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 60%, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 100%);
							background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>), color-stop(40%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>), color-stop(50%,<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>), color-stop(60%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>), color-stop(100%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>));
							background: -webkit-linear-gradient(-45deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 0%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 40%,<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 50%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 60%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 100%);
							background: -o-linear-gradient(-45deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 0%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 40%,<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 50%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 60%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 100%);
							background: -ms-linear-gradient(-45deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 0%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 40%,<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 50%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 60%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 100%);
							background: linear-gradient(135deg, <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 0%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 40%,<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?> 50%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 60%,<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?> 100%);
							filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>', endColorstr='<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>',GradientType=1 );
							background-position:0px;
							background-size:300%;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover
						{
							animation:light 1s;
							-moz-animation:light 1s;
							-webkit-animation:light 1s;
							color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
						}
						@keyframes light
						{
							0% {
								<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05 != 'full'){ ?>
									background-position:-600px;
								<?php }else{ ?>
									background-position:-2000px;
								<?php }?>
							} 100% { background-position:0px; }
						}
						@-webkit-keyframes light 
						{
							0% {
								<?php if($TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_05 != 'full'){ ?>
									background-position:-600px;
								<?php }else{ ?>
									background-position:-2000px;
								<?php }?>
							} 100% { background-position:0px; }
						}
						.TotalSoft_PG_LG_LInk_S { display: none; }
					<?php }else if( $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01 == 'style05' ){ ?>
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk
						{
							position: relative;
							cursor:pointer;
							z-index:5;
							overflow:hidden;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>;
							transition: all .5s ease-in-out;
							-moz-transition: all .5s ease-in-out;
							-webkit-transition: all .5s ease-in-out;
							display: inline-block;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk .TotalSoft_PG_LG_LInk_S
						{
							z-index: -2;
							display:inline-block;
							position:absolute;
							background-color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
							width: 300%;
							height: 300%;
							margin-left: 100%;
							transition:all .8s ease-in-out;
							-moz-transition:all .8s ease-in-out;
						-webkit-transition:all .8s ease-in-out;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover .TotalSoft_PG_LG_LInk_S
						{
							transform:scale(2,2) skew(110deg);
							-moz-transform:scale(2,2) skew(110deg);
							-webkit-transform:scale(2,2) skew(110deg);
						}
					<?php }else if( $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01 == 'style06' ){ ?>
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk
						{
							position: relative;
							cursor:pointer;
							z-index:5;
							overflow:hidden;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>;
							transition: all .5s ease-in-out;
							-moz-transition: all .5s ease-in-out;
							-webkit-transition: all .5s ease-in-out;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
							background-color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk .TotalSoft_PG_LG_LInk_S
						{
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
							cursor:pointer;
							z-index:5;
							overflow:hidden;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk .TotalSoft_PG_LG_LInk_S:after
						{
							z-index:-2;
							content:"";
							display:inline-block;
							position:absolute;
							right: 10%;
							top: 10%;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk .TotalSoft_PG_LG_LInk_S:before
						{
							z-index: -2;
							content:"";
							display:inline-block;
							position:absolute;
							left: 10%;
							top: 10%;
							transition: all .7s ease-in-out;
							-moz-transition: all .7s ease-in-out;
							-webkit-transition: all .7s ease-in-out;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk .TotalSoft_PG_LG_LInk_S:before, .TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk .TotalSoft_PG_LG_LInk_S:after
						{
							border:2px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
							border-radius:50%;
							transition:all 1s ease-in-out;
							-moz-transition:all 1s ease-in-out;
							-webkit-transition:all 1s ease-in-out;
							transform:scale(0,0) rotate(0deg);
							-moz-transform:scale(0,0) rotate(0deg);
							-webkit-transform:scale(0,0) rotate(0deg);
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover .TotalSoft_PG_LG_LInk_S:before, .TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover .TotalSoft_PG_LG_LInk_S:after
						{
							border-radius:1%;
							transform:scale(4,4) rotate(120deg);
							-moz-transform:scale(4,4) rotate(120deg);
							-webkit-transform:scale(4,4) rotate(120deg);
							padding:60px 100px;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover .TotalSoft_PG_LG_LInk_S:before { padding-right:10px; }
					<?php }else if( $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_01 == 'style07' ){ ?>
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk
						{
							position: relative;
							cursor:pointer;
							z-index:5;
							overflow:hidden;
							background-color: <?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_36;?>;
							transition: all .5s ease-in-out;
							-moz-transition: all .5s ease-in-out;
							-webkit-transition: all .5s ease-in-out;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover
						{
							color: <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_03;?>;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk .TotalSoft_PG_LG_LInk_S
						{
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
							cursor:pointer;
							overflow:hidden;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk .TotalSoft_PG_LG_LInk_S:before
						{
							display:inline-block;
							content:"";
							position:absolute;
							width: 3px;
							height: 2px;
							top: 50%;
							left: 50%;
							border-right:0px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
							border-top:0px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
							border-radius:50%;
							padding:1px;
							transition:transform 1s ease-in-out;
							-moz-transition:transform 1s ease-in-out;
							-webkit-transition:transform 1s ease-in-out;
						}
						.TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> .TotalSoft_PG_LG_LInk:hover .TotalSoft_PG_LG_LInk_S:before
						{
							transform: rotate(750deg) scale(71,71);
							-moz-transform: rotate(750deg) scale(71,71);
							-webkit-transform: rotate(750deg) scale(71,71);
							border-right:1px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
							border-top:1px solid <?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_02;?>;
						}
					<?php }?>
				</style>
				<div class="TotalSoft_PG_LG_Button_Div_<?php echo $Total_Soft_Portfolio;?>">
					<div class="TotalSoft_PG_LG_Button_Div1_<?php echo $Total_Soft_Portfolio;?>"></div>
					<?php if($TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect04' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect05' || $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_09 == 'effect06'){ ?>
						<div class="TotalSoft_PG_LG_Button_Div2_<?php echo $Total_Soft_Portfolio;?>">
							<span class="TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>"><?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01;?></span>
							<button class="TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?> TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>" data-rel<?php echo $Total_Soft_Portfolio;?>="<?php echo str_replace(" ","", $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01) . $Total_Soft_Portfolio;?>">
								<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01;?>
							</button>
						</div>
						<?php for($i=0;$i<$TotalSoftPortfolioManager[0]->TotalSoftPortfolio_AlbumCount;$i++){ ?>
							<div class="TotalSoft_PG_LG_Button_Div2_<?php echo $Total_Soft_Portfolio;?>">
								<span class="TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>"><?php echo $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle;?></span>
								<button class="TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>" data-rel<?php echo $Total_Soft_Portfolio;?>="<?php echo str_replace(" ","", $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle) . $Total_Soft_Portfolio;?>">
									<?php echo $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle;?>
								</button>
							</div>
						<?php }?>
					<?php }else{ ?>
						<button class="TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?> TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>" data-rel<?php echo $Total_Soft_Portfolio;?>="<?php echo str_replace(" ","", $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01) . $Total_Soft_Portfolio;?>">
							<span class="TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>"><?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_01;?></span>
						</button>
						<?php for($i=0;$i<$TotalSoftPortfolioManager[0]->TotalSoftPortfolio_AlbumCount;$i++){ ?>
							<button class="TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>" data-rel<?php echo $Total_Soft_Portfolio;?>="<?php echo str_replace(" ","", $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle) . $Total_Soft_Portfolio;?>">
								<span class="TotalSoft_PG_LG_Button_Span_<?php echo $Total_Soft_Portfolio;?>"><?php echo $TotalSoftPortfolioAlbums[$i]->TotalSoftPortfolio_ATitle;?></span>
							</button>
						<?php }?>
					<?php }?>
				</div>
				<div class="TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?>" ng-class="{'no-scroll<?php echo $Total_Soft_Portfolio;?>': selected<?php echo $Total_Soft_Portfolio;?>.length}" ng-module="app<?php echo $Total_Soft_Portfolio;?>" ng-controller="mainCtrl<?php echo $Total_Soft_Portfolio;?>">
					<div class="TotalSoft_PG_LG_Page_<?php echo $Total_Soft_Portfolio;?>">
						<div class="TotalSoft_PG_LG_Grid_<?php echo $Total_Soft_Portfolio;?>">
							<div class="TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?> {{item.album}} All<?php echo $Total_Soft_Portfolio;?> TotalSoft_PG_Anim<?php echo $Total_Soft_Portfolio;?>" ng-repeat="item in boxes">
								<box class="TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?>" item="item" on-select="selectBox<?php echo $Total_Soft_Portfolio;?>" ng-class="{'selected<?php echo $Total_Soft_Portfolio;?>': selected<?php echo $Total_Soft_Portfolio;?>[0].item.name == item.name}">
									<?php if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect01' ){ ?>
										<i class="TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>"></i>
										<div class="TotalSoft_PG_LG_Box_Curl_<?php echo $Total_Soft_Portfolio;?>"></div>
									<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect02' ){ ?>
										<div class="TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>">
											<div class="TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>"></div>
											<div class="TotalSoft_PG_LG_Box_Hover2_<?php echo $Total_Soft_Portfolio;?>">
												<i class="TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>"></i>
											</div>
										</div>
										<span class="TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>">{{item.name}}</span>
									<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect03' ){ ?>
										<div class="TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>"></div>
										<span class="TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>">{{item.name}}</span>
									<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect04' ){ ?>
										<div class="TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>"></div>
										<span class="TotalSoft_PG_LG_Box_Icon_Span_<?php echo $Total_Soft_Portfolio;?>">
											<span class="TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>">{{item.name}}</span>
											<i class="TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>"></i>
										</span>
									<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect05' ){ ?>
										<div class="TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>">
											<div class="TotalSoft_PG_LG_Box_Hover1_<?php echo $Total_Soft_Portfolio;?>"></div>
										</div>
										<i class="TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>"></i>
									<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect06' ){ ?>
										<div class="TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>"></div>
										<i class="TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>"></i>
									<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect07' ){ ?>
										<div class="TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>"></div>
										<span class="TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>">{{item.name}}</span>
									<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect08' ){ ?>
										<div class="TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>">
											<div>
												<i class="TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>"></i>
											</div>
											<div>
												<span class="TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>">{{item.name}}</span>
											</div>
										</div>
									<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect09' ){ ?>
										<div class="TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>"></div>
										<i class="TotalSoft_PG_LG_Box_Icon_<?php echo $Total_Soft_Portfolio;?> totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_19;?>"></i>
									<?php }else if( $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_16 == 'effect10' ){ ?>
										<div class="TotalSoft_PG_LG_Box_Hover_<?php echo $Total_Soft_Portfolio;?>"></div>
										<span class="TotalSoft_PG_LG_Box_Title_<?php echo $Total_Soft_Portfolio;?>">{{item.name}}</span>
									<?php }?>
								</box>
							</div>
						</div>
					</div>
					<div class="fullscreen-background top-up" ng-show="selected<?php echo $Total_Soft_Portfolio;?>.length" ng-style="{'background-image': 'url(' + selected<?php echo $Total_Soft_Portfolio;?>[0].item.image + ')'}"></div>
					<div class="scroller<?php echo $Total_Soft_Portfolio;?>" ng-show="selected<?php echo $Total_Soft_Portfolio;?>.length">
						<i class="close-button totalsoft totalsoft-<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_29;?>" ng-click="clearSelection<?php echo $Total_Soft_Portfolio;?>()">
						</i>
						<h1>{{selected<?php echo $Total_Soft_Portfolio;?>[0].item.name}}</h1>
						<div big-box ng-repeat="item in selected<?php echo $Total_Soft_Portfolio;?>" class="TotalSoft_PG_LG_Box_<?php echo $Total_Soft_Portfolio;?> on-top" position="item.position" selected<?php echo $Total_Soft_Portfolio;?>="item.item">
							<div class="content"></div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					(function() {
						function initNgModules(element) {
							var elements = [element],
								moduleElements = [],
								modules = [],
								names = ['ng:module', 'ng-module', 'x-ng-module', 'data-ng-module', 'ng:modules', 'ng-modules', 'x-ng-modules', 'data-ng-modules'],
								NG_MODULE_CLASS_REGEXP = /\sng[:\-]module[s](:\s*([\w\d_]+);?)?\s/;
							function append(element) { element && elements.push(element); }
							for(var i = 0; i < names.length; i++)
							{
								var name = names[i];
								append(document.getElementById(name));
								name = name.replace(':', '\\:');
								if (element.querySelectorAll)
								{
									var elements2;
									elements2 = element.querySelectorAll('.' + name);
									for(var j = 0; j < elements2.length; j++) append(elements2[j]);
									elements2 = element.querySelectorAll('.' + name + '\\:');
									for(var j = 0; j < elements2.length; j++) append(elements2[j]);
									elements2 = element.querySelectorAll('[' + name + ']');
									for(var j = 0; j < elements2.length; j++) append(elements2[j]);
								}
							}
							for(var i = 0; i < elements.length; i++)
							{
								var element = elements[i];
								var className = ' ' + element.className + ' ';
								var match = NG_MODULE_CLASS_REGEXP.exec(className);
								if (match) { moduleElements.push(element); modules.push((match[2] || '').replace(/\s+/g, ',')); }
								else
								{
									if(element.attributes)
									{
										for(var j = 0; j < element.attributes.length; j++)
										{
											var attr = element.attributes[j];
											if (names.indexOf(attr.name) != -1) { moduleElements.push(element); modules.push(attr.value); }
										}
									}
								}
							}
							for(var i = 0; i < moduleElements.length; i++)
							{
								var moduleElement = moduleElements[i];
								var module = modules[i].replace(/ /g,'').split(",");
								angular.bootstrap(moduleElement, module);
							}
						}
						angular.element(document).ready(function() { initNgModules(document); });
					})();
				</script>
				<script type="text/javascript">
					jQuery(window).load(function(){
						jQuery(".TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .fullscreen-background").css("background-color","#333");
						jQuery(".TotalSoft_PG_LG_Container_<?php echo $Total_Soft_Portfolio;?> .close-button").css("display","inline-block");
					})
					if(jQuery("article").hasClass("page")) { jQuery("article.page").css("transform","none"); jQuery("article.page").css("webkitTransform","none"); }
					var selectedClass<?php echo $Total_Soft_Portfolio;?> = "";
					jQuery(".TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>").click(function(){
						if(!jQuery(this).hasClass('TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>'))
						{
							jQuery(".TotalSoft_PG_LG_Button_<?php echo $Total_Soft_Portfolio;?>").removeClass('TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>');
							jQuery(this).addClass('TotalSoft_PG_LG_Button_Ch_<?php echo $Total_Soft_Portfolio;?>');
							selectedClass<?php echo $Total_Soft_Portfolio;?> = jQuery(this).attr("data-rel<?php echo $Total_Soft_Portfolio;?>");
							jQuery(".TotalSoft_PG_LG_Grid_<?php echo $Total_Soft_Portfolio;?>").fadeTo(100, 0.1);
							jQuery(".TotalSoft_PG_LG_Grid_Item_<?php echo $Total_Soft_Portfolio;?>").not("."+selectedClass<?php echo $Total_Soft_Portfolio;?>).fadeOut().removeClass('TotalSoft_PG_Anim<?php echo $Total_Soft_Portfolio;?>');
							setTimeout(function() {
								jQuery("."+selectedClass<?php echo $Total_Soft_Portfolio;?>).fadeIn().addClass('TotalSoft_PG_Anim<?php echo $Total_Soft_Portfolio;?>');
								jQuery(".TotalSoft_PG_LG_Grid_<?php echo $Total_Soft_Portfolio;?>").fadeTo(300, 1);
							}, 300);
						}
					});
					var app<?php echo $Total_Soft_Portfolio;?> = angular.module('app<?php echo $Total_Soft_Portfolio;?>', ['ngAnimate'])
					app<?php echo $Total_Soft_Portfolio;?>.controller('mainCtrl<?php echo $Total_Soft_Portfolio;?>', function($scope) {
						$scope.boxes = [
							<?php for($i=0;$i<count($TotalSoftPortfolioImages);$i++){ ?>
								{
									album: '<?php echo str_replace(' ', '', $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IA) . $Total_Soft_Portfolio;?>',
									name: '<?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IT);?>',
									image: '<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IURL;?>',
									desc: '<?php echo html_entity_decode($TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IDesc);?>',
									link: '<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_ILink;?>',
									linkon: '<?php echo $TotalSoftPortfolioImages[$i]->TotalSoftPortfolio_IONT;?>',
									linktext: '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_37;?>',
									linkpos: '<?php echo $TotalSoftPortfolioOpt2[0]->TotalSoft_PG_2_04;?>',
									icontype: '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_38;?>',
									iconpos: '<?php echo $TotalSoftPortfolioOpt1[0]->TotalSoft_PG_1_39;?>'
								},
							<?php }?>
						];
						$scope.selected<?php echo $Total_Soft_Portfolio;?> = [];
						$scope.selectBox<?php echo $Total_Soft_Portfolio;?> = function(item, position) {
							$scope.selected<?php echo $Total_Soft_Portfolio;?> = [{
								item: item,
								position: position
							}];
							$scope.$apply();
						}
						$scope.clearSelection<?php echo $Total_Soft_Portfolio;?> = function() {
							$scope.selected<?php echo $Total_Soft_Portfolio;?> = [];
						}
					})
					app<?php echo $Total_Soft_Portfolio;?>.directive('box', function() {
						return {
							restrict: 'E',
							scope: {},
							bindToController: {
								onSelect: "=",
								item: "="
							},
							controllerAs: 'box',
							controller: function() {
								var box = this;
								box.goFullscreen = function(e) {
									box.onSelect(box.item, e.target.getBoundingClientRect())
								}
							},
							link: function(scope, element) {
								element.bind('click', scope.box.goFullscreen)
								element.css({
									'background-image': 'url(' + scope.box.item.image + ')'
								})
							}
						}
					})
					app<?php echo $Total_Soft_Portfolio;?>.directive('bigBox', function($timeout) {
						return {
							restrict: 'AE',
							scope: {},
							bindToController: {
								position: "=",
								selected<?php echo $Total_Soft_Portfolio;?>: "=",
								onSelect: "="
							},
							controllerAs: 'box',
							controller: function() {
								var box = this;
							},
							link: function(scope, element) {
								var TotalSoft_PG_LG_Link = '';
								var TotalSoft_PG_LG_Link_ONT = '';
								var TotalSoft_PG_LG_Link_IA = '';
								var TotalSoft_PG_LG_Link_IB = '';
								if(scope.box.selected<?php echo $Total_Soft_Portfolio;?>.link.length > 0)
								{
									if(scope.box.selected<?php echo $Total_Soft_Portfolio;?>.linkon == 'true')
									{
										TotalSoft_PG_LG_Link_ONT = '_blank';
									}
									if(scope.box.selected<?php echo $Total_Soft_Portfolio;?>.iconpos == 'after')
									{
										TotalSoft_PG_LG_Link_IA = '<i class="totalsoft totalsoft-'+scope.box.selected<?php echo $Total_Soft_Portfolio;?>.icontype+'" style="margin-left: 10px;"></i>'
									}
									if(scope.box.selected<?php echo $Total_Soft_Portfolio;?>.iconpos == 'before')
									{
										TotalSoft_PG_LG_Link_IB = '<i class="totalsoft totalsoft-'+scope.box.selected<?php echo $Total_Soft_Portfolio;?>.icontype+'" style="margin-right: 10px;"></i>'
									}
									TotalSoft_PG_LG_Link = '<span class="TotalSoft_PG_LG_LInk_Span"><a class="TotalSoft_PG_LG_LInk" target="'+TotalSoft_PG_LG_Link_ONT+'" href="'+scope.box.selected<?php echo $Total_Soft_Portfolio;?>.link+'"><span class="TotalSoft_PG_LG_LInk_S"></span>'+TotalSoft_PG_LG_Link_IB+scope.box.selected<?php echo $Total_Soft_Portfolio;?>.linktext+TotalSoft_PG_LG_Link_IA+'</a></span>';
								}
								if(scope.box.selected<?php echo $Total_Soft_Portfolio;?>.linkpos == 'after')
								{
									element.find('div').html(scope.box.selected<?php echo $Total_Soft_Portfolio;?>.desc + TotalSoft_PG_LG_Link);
								}
								else if(scope.box.selected<?php echo $Total_Soft_Portfolio;?>.linkpos == 'before')
								{
									element.find('div').html(TotalSoft_PG_LG_Link + scope.box.selected<?php echo $Total_Soft_Portfolio;?>.desc);
								}
								var css = {}
								for (var key in scope.box.position) { css[key] = scope.box.position[key] + 'px'; }
								element.css(css);
								if(scope.box.selected<?php echo $Total_Soft_Portfolio;?>.desc.length > 0 || scope.box.selected<?php echo $Total_Soft_Portfolio;?>.link.length > 0)
								{
									$timeout(function() { element.css({ top: '50%', left: '10%' }) }, 200)
								}
								else
								{
									$timeout(function() { element.css({ top: '50%', left: '10%', opacity: '0' }) }, 200)
								}
								$timeout(function() { element.css({ width: '80%', height: '50%' }) }, 500)
								$timeout(function() { element.addClass('show'); }, 800)
							}
						}
					})
				</script>
			<?php }
			echo $after_widget;
		}
	}
?>