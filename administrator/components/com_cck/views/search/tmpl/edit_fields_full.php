<?php
/**
* @version 			SEBLOD 3.x Core ~ $Id: edit_fields_full.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

$bar		=	( $this->uix == 'full' ) ? 'on' : 'off';
$data		=	Helper_Workshop::getParams( 'search', $this->item->master, $this->item->client );
$data2      =   array(
                    'construction'=>array(
                                        'access'=>array( '_' ),
                                        'link'=>array( '_' ),
                                        'live'=>array( '_' ),
                                        'markup'=>array( '_' ),
                                        'match_mode'=>array( '_' ),
                                        'restriction'=>array( '_' ),
                                        'stage'=>array( '_' ),
                                        'typo'=>array( '_' ),
                                        'variation'=>array( '_' )
                                    )
                );
$positions	=	array();
$attr       =   array( 'class'=>' b', 'span'=>'<span class="icon-pencil-2"></span>' );
?>
<div class="<?php echo $this->css['wrapper2'].' '.$this->uix; ?>">
    <div class="<?php echo $this->css['w70']; ?>" id="seblod-main">
        <div class="seblod">
            <div class="legend top left"><?php echo JText::_( 'COM_CCK_CONSTRUCTION_'.$this->uix ) . '<span class="mini">('.JText::_( 'COM_CCK_FOR_VIEW_'.$this->item->client ).')</span>'; ?></div>
            <?php
            $ijk    =   0;
			$style	=	array( '1'=>'', '2'=>' hide', '3'=>' hide', '4'=>' hide', '5'=>' hide', '6'=>' hide', '7'=>' hide' );
            Helper_Workshop::displayHeader( 'search', $this->item->master );
            echo '<ul class="sortable connected" id="sortable1" myid="1">';
            if ( $this->item->client == 'order' ) {
				Helper_Workshop::displayPositionStatic( 1, 'mainbody', '# '.JText::_( 'COM_CCK_ORDER_BY' ) );
                if ( isset( $this->fields['mainbody'] ) ) {
                    foreach ( $this->fields['mainbody'] as $field ) {
                        $type_field		=	'';
                        if ( isset( $this->type_fields[$field->id] ) ) {
                            $type_field	=	' c-'.$this->type_fields[$field->id]->cc;
                        }
                        JCck::callFunc_Array( 'plgCCK_Field'.$field->type, 'onCCK_FieldConstruct_Search'.$this->item->master, array( &$field, $style, $data, &$data2 ) );
                        Helper_Workshop::displayField( $field, $type_field, $attr );
                    }
                }
				Helper_Workshop::displayPositionEnd();
            } else {
                if ( $this->item->client == 'list' && ! $this->item->template ) {
                    echo '<li class="position ui-state-disabled" id="pos-1"><span class="title capitalize"># '.JText::_( 'COM_CCK_SELECT_LIST_TEMPLATE' ).'</span></li>';
					Helper_Workshop::displayPositionEnd();
                } else {
                    echo '<li class="position p-no ui-state-disabled boundary" id="pos-0"><input class="selector" type="radio" id="position0" name="positions" gofirst="#pos-0" golast="#pos-1"><span class="title"></span><input type="hidden" name="ff[pos-_pre_]" value="position" /></li>';

                    if ( isset( $this->fields['_pre_'] ) ) {
                        foreach ( $this->fields['_pre_'] as $field ) {
                            $type_field     =   '';
                            if ( isset( $this->type_fields[$field->id] ) ) {
                                $type_field =   ' c-'.$this->type_fields[$field->id]->cc;
                            }
                            JCck::callFunc_Array( 'plgCCK_Field'.$field->type, 'onCCK_FieldConstruct_Search'.$this->item->master, array( &$field, $style, $data, &$data2 ) );
                            Helper_Workshop::displayField( $field, $type_field, $attr );
                        }
                    }

					if ( $this->positions_nb ) {
                        if ( $this->item->client == 'list' ) {
                            $ijk++;

                            $this->setPosition( '_above_', 'ABOVE', '<span class="no">↑</span>' );

                            if ( isset( $this->fields['_above_'] ) ) {
                                foreach ( $this->fields['_above_'] as $field ) {
                                    $type_field     =   '';
                                    if ( isset( $this->type_fields[$field->id] ) ) {
                                        $type_field =   ' c-'.$this->type_fields[$field->id]->cc;
                                    }
                                    JCck::callFunc_Array( 'plgCCK_Field'.$field->type, 'onCCK_FieldConstruct_Search'.$this->item->master, array( &$field, $style, $data, &$data2 ) );
                                    Helper_Workshop::displayField( $field, $type_field, $attr );
                                }
                            }
                        }   
						foreach ( $this->positions as $pos ) {
                            if ( $pos->name == '_above_' || $pos->name == '_below_' ) {
                                continue;
                            }
							if ( isset( $this->fields[$pos->name] ) ) {
								$this->setPosition( $pos->name, @$pos->title );
								foreach ( $this->fields[$pos->name] as $field ) {
									$type_field		=	'';
									if ( isset( $this->type_fields[$field->id] ) ) {
										$type_field	=	' c-'.$this->type_fields[$field->id]->cc;
									}
									JCck::callFunc_Array( 'plgCCK_Field'.$field->type, 'onCCK_FieldConstruct_Search'.$this->item->master, array( &$field, $style, $data, &$data2 ) );
									Helper_Workshop::displayField( $field, $type_field, $attr );
								}
							} else {
								$positions[] =   array( 'name'=>$pos->name, 'title'=>$pos->title );
							}
                            $ijk++;
						}
						foreach ( $positions as $pos ) {
							$this->setPosition( $pos['name'], $pos['title'] );
						}

                        if ( $this->item->client == 'list' ) {
                            $ijk++;

                            $this->setPosition( '_below_', 'BELOW', '<span class="no">↓</span>' );

                            if ( isset( $this->fields['_below_'] ) ) {
                                foreach ( $this->fields['_below_'] as $field ) {
                                    $type_field     =   '';
                                    if ( isset( $this->type_fields[$field->id] ) ) {
                                        $type_field =   ' c-'.$this->type_fields[$field->id]->cc;
                                    }
                                    JCck::callFunc_Array( 'plgCCK_Field'.$field->type, 'onCCK_FieldConstruct_Search'.$this->item->master, array( &$field, $style, $data, &$data2 ) );
                                    Helper_Workshop::displayField( $field, $type_field, $attr );
                                }
                            }
                        }

                        $ijk++;

                        echo '<li class="position p-no ui-state-disabled" id="pos-'.$ijk.'"><input class="selector" type="radio" id="position0" name="positions" gofirst="#pos-'.$ijk.'" golast="#pos-'.( $ijk + 1 ).'"><span class="title"></span><input type="hidden" name="ff[pos-_post_]" value="position" /></li>';

                        if ( isset( $this->fields['_post_'] ) ) {
                            foreach ( $this->fields['_post_'] as $field ) {
                                $type_field     =   '';
                                if ( isset( $this->type_fields[$field->id] ) ) {
                                    $type_field =   ' c-'.$this->type_fields[$field->id]->cc;
                                }
                                JCck::callFunc_Array( 'plgCCK_Field'.$field->type, 'onCCK_FieldConstruct_Search'.$this->item->master, array( &$field, $style, $data, &$data2 ) );
                                Helper_Workshop::displayField( $field, $type_field, $attr );
                            }
                        }

						Helper_Workshop::displayPositionEnd( ++$this->positions_nb );
					} else {
						echo '<li class="position ui-state-disabled" id="pos-1"><span class="title capitalize"># '.JText::_( 'COM_CCK_NO_POSITION_AVAILABLE' ).'</span></li>';
						Helper_Workshop::displayPositionEnd();
					}
                }
            }
            echo '</ul>';
            ?>
        </div>
    </div>
    
    <div class="<?php echo $this->css['w30'].' '.$bar; ?> active" id="seblod-sidebar">
        <div class="seblod" id="seblod-sideblock">
            <div class="fltlft seblod-toolbar"><?php Helper_Workshop::displayToolbar( 'search', $this->item->master, $this->item->client, $this->uix, '' ); ?></div>
            <div class="legend top flexenter"><?php echo $this->lists['af_f'].$this->lists['af_c'].'<br />'.$this->lists['af_t'].$this->lists['af_a'] ?></div>
            <div id="scroll">
                <ul class="sortable connected" id="sortable2" myid="2">
        			<?php include __DIR__.'/edit_fields_av.php'; ?>
                </ul>
            </div>
            <div style="display: none;">
                <ul id="sortable3"></ul>
            </div>
        </div>
    </div>
</div>
<div class="clr" id="seblod-cleaner"></div>
<div id="layer_fields_options" class="hide hidden" style="display: none;">
    <?php
    if ( isset( $data2['construction'] ) && count( $data2['construction'] ) ) {
        foreach ( $data2['construction'] as $k=>$v ) {
            if ( count( $v ) ) {
                foreach ( $v as $k2=>$v2 ) {
                    if ( $k2 == '_' ) {
                        if ( isset( $data[$k] ) ) {
                            if ( $k == 'variation' ) {
                                 $data['variation']['300']  =   JHtml::_( 'select.option', '<OPTGROUP>', JText::_( 'COM_CCK_STAR_IS_SECURED' ) );
                                 $data['variation']['301']  =   JHtml::_( 'select.option', '</OPTGROUP>', '' );    
                            }
                            echo JHtml::_( 'select.genericlist', $data[$k], '_wk_'.$k, 'size="1" class="thin hide" data-type="'.$k.'"', 'value', 'text', '' );
                        }
                    } else {
                        if ( count( $v2 ) ) {
                            echo JHtml::_( 'select.genericlist', $v2, '_wk_'.$k.'-'.$k2, 'size="1" class="thin hide" data-type="'.$k.'"', 'value', 'text', '' );
                        }
                    }
                }
            }
        }
    }
    ?>
</div>
