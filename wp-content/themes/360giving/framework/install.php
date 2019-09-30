<?php


	function install()
	{

		$create = array();

		// PAGES

		$create[] = array(
				'post_type' => 'post',
				'post_parent' => 0,
				'post_author' => 1,
				'post_status' => 'publish',
				'post_date' => date('Y-m-d H:i:s', strtotime('now - ' .  rand(0,365) . ' days')),
				'post_title' => 'Ut vix molestiae pertinacia, eu vocibus dignissim neglegentur',
				'post_content' => lorem(),
			);

		$create[] = array(
				'post_type' => 'post',
				'post_parent' => 0,
				'post_author' => 1,
				'post_status' => 'publish',
				'post_date' => date('Y-m-d H:i:s', strtotime('now - ' .  rand(0,365) . ' days')),
				'post_title' => 'Mel dictas scriptorem ei, alii omittam mel ei. Vide labores splendide',
				'post_content' => lorem(),
			);

		$create[] = array(
				'post_type' => 'post',
				'post_parent' => 0,
				'post_author' => 1,
				'post_status' => 'publish',
				'post_date' => date('Y-m-d H:i:s', strtotime('now - ' .  rand(0,365) . ' days')),
				'post_title' => 'Ceteros definiebas vis in, est',
				'post_content' => lorem(),
			);

		$create[] = array(
				'post_type' => 'post',
				'post_parent' => 0,
				'post_author' => 1,
				'post_status' => 'publish',
				'post_date' => date('Y-m-d H:i:s', strtotime('now - ' .  rand(0,365) . ' days')),
				'post_title' => 'Lorem ipsum dolor sit amet, sonet accusata expetenda',
				'post_content' => lorem(),
			);

		$create[] = array(
				'post_type' => 'post',
				'post_parent' => 0,
				'post_author' => 1,
				'post_status' => 'publish',
				'post_date' => date('Y-m-d H:i:s', strtotime('now - ' .  rand(0,365) . ' days')),
				'post_title' => 'Falli melius tincidunt nec ei. His autem oportere',
				'post_content' => lorem(),
			);

		$create[] = array(
				'post_type' => 'post',
				'post_parent' => 0,
				'post_author' => 1,
				'post_status' => 'publish',
				'post_date' => date('Y-m-d H:i:s', strtotime('now - ' .  rand(0,365) . ' days')),
				'post_title' => 'Albucius urbanitas no nam, in mei quidam feugait percipit',
				'post_content' => lorem(),
			);

		foreach ( $create as $post )
		{
			wp_insert_post($post, false);
		}

		wp_update_term(1, 'category', array('name' => 'News', 'slug' => 'news'));

	}

	function lorem()
	{

		$lorem[0] = '<p class="lead">Ut vix molestiae pertinacia, eu vocibus dignissim neglegentur per, usu id commodo oblique.</p>';
		$lorem[0] .= '<p>Sint tractatos dissentiunt his ei. Ex mei fugit aliquid. Ut sed harum soleat, cibo eripuit et mea, id doctus reprimique vim. Mel ad omnes vitae interesset, eam doctus aperiam no. Ad est clita ancillae, malorum complectitur ne vim.<p>';
		$lorem[0] .= '<p>Sint tractatos dissentiunt his ei. Ex mei fugit aliquid. Ut sed harum soleat, cibo eripuit et mea, id doctus reprimique vim. Mel ad omnes vitae interesset, eam doctus aperiam no. Ad est clita ancillae, malorum complectitur ne vim.<p>';
		$lorem[0] .= '<p>Ceteros definiebas vis in, est posse doming id, vel habeo maiestatis ei. Esse inani dissentiet in vis. Inani fierent adipiscing duo cu. Corrumpit imperdiet nec ei. Voluptaria dissentiet nam cu, vix wisi consulatu ea. Assum virtute sapientem ne sed, no vide possit referrentur per, no sit nostrud praesent expetenda.<p>';

		$lorem[1] = '<p class="lead">Exerci dolorem expetendis mea et, cum id iudico tempor. Putant sensibus at eum. </p>';
		$lorem[1] .= '<p>Mel dictas scriptorem ei, alii omittam mel ei. Vide labores splendide nec in, mei minim legere vituperata ut. Ad eos dolores deserunt conclusionemque, no everti voluptaria voluptatum quo, ea eum dicam accusata assentior. Ius debet possim ea, te graece essent senserit sit, veri abhorreant eu qui.<p>';
		$lorem[1] .= '<p>Lorem ipsum dolor sit amet, libris perpetua comprehensam vis ex, vim cu dicunt delenit nominati. No duo choro similique, mea ex vidisse labitur vivendo, quo perfecto platonem recteque cu. Ne nec dicam semper, in eam elitr causae delicatissimi. Tamquam sapientem ei cum, te alii luptatum constituam his, ea dicam docendi eam. Mea an inermis imperdiet, vim nostrum facilisis et, no eum utamur eripuit aliquando.</p>';

		$lorem[2] = '<p class="lead">Mel dictas scriptorem ei, alii omittam mel ei. Vide labores splendide.</p>';
		$lorem[2] .= '<p>Albucius urbanitas no nam, in mei quidam feugait percipit. Quo te ferri scripserit vituperatoribus. An usu nostrud omittam partiendo. Qui at esse eros euismod, pri quem splendide ea. Cu salutatus temporibus has, te sea prompta invenire, te has odio ancillae disputando. Te vix facer dicit graece, cum te causae dissentiunt delicatissimi.<p>';
		$lorem[2] .= '<p>Falli melius tincidunt nec ei. His autem oportere adversarium cu, te novum corpora vix, eos eu mutat forensibus intellegebat. Ei populo nominati scribentur eam, no menandri eloquentiam nam, nam solum apeirian id. Commune abhorreant in eam, nec dico molestie constituam ad. Eum ad facer probatus.</p>';

		$lorem[3] = '<p class="lead">Lorem ipsum dolor sit amet, sonet accusata expetenda ne eos, te his saepe vulputate reformidans.</p>';
		$lorem[3] .= '<p>Lorem ipsum dolor sit amet, libris perpetua comprehensam vis ex, vim cu dicunt delenit nominati. No duo choro similique, mea ex vidisse labitur vivendo, quo perfecto platonem recteque cu. Ne nec dicam semper, in eam elitr causae delicatissimi. Tamquam sapientem ei cum, te alii luptatum constituam his, ea dicam docendi eam. Mea an inermis imperdiet, vim nostrum facilisis et, no eum utamur eripuit aliquando.<p>';
		$lorem[3] .= '<p>Ad qui veri posse dicit, interesset delicatissimi pri ex. His accumsan rationibus at, ad vix civibus senserit. Usu quem porro argumentum eu, vel an etiam inimicus. Sea in menandri petentium scribentur. Eu has nusquam pericula facilisis, ne clita gloriatur mel. Qui latine maiorum omnesque cu, nec eu porro veritus, ut omnes tollit feugiat est.</p>';
		$lorem[3] .= '<p>Falli melius tincidunt nec ei. His autem oportere adversarium cu, te novum corpora vix, eos eu mutat forensibus intellegebat. Ei populo nominati scribentur eam, no menandri eloquentiam nam, nam solum apeirian id. Commune abhorreant in eam, nec dico molestie constituam ad. Eum ad facer probatus.</p>';

		return  $lorem[ rand( 0, (count($lorem)-1) ) ];

	}

	install();

?>