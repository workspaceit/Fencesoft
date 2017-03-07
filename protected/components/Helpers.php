<?php
class Helpers {
	
	public function prd($data){
		echo '<pre>';
		print_r($data);
		die();
	}
	
	public function dd($data){
		echo '<pre>';
		var_dump($data);
		die();
	}
	
	public function getFenceByQuery($data,$networkType,$siteID){		
		
		if(isset($data['search_type']) && $data['search_type']=='search_advance'){
			
			return $this->getFenceByAdvanceQuery($data,$networkType,$siteID);
			
		} else if(isset($data['search_type']) && $data['search_type']=='single'){
			
			return $this->getFenceBySingleQuery($data,$networkType,$siteID);
			
		} else if(isset($data['search_type']) && $data['search_type']=='generic') {
			
			return $this->getFenceBySimpleQuery($data,$networkType,$siteID);
		}		
		
	}
	
	public function getFenceBySimpleQuery($data,$networkType,$siteID){
	    
	    function innerGetQueryResult($model,$networkType,$search,$siteID){
	        return Yii::app()->db->createCommand()
            	    ->select('*')
            	    ->from($model->tableName())
            	    ->where(array('and','network_type="'.$networkType.'"','is_hide=0','store_id='.$siteID,
                	            array('or',
            	                    'system_id LIKE "%'.$search.'%"',
            	                    'system_name LIKE "%'.$search.'%"',
            	                    'short_description LIKE "%'.$search.'%"',
            	                    'description LIKE "%'.$search.'%"',
                	            )
            	            ))
            	    ->queryAll();
	    }
	    
		$fences = array();
	    $i = 0;
	    $search = $data['search'];
	    $model = AluminumFences::model();
	    $materials = innerGetQueryResult($model,$networkType,$search,$siteID);
	   
        if(!empty($materials)){
            foreach ($materials as $key=>$material){
                
                $material['type_of_fence'] = 'Aluminum';
                $fences[$i] = $material;
                $i++;                
            }
        }
        
        $model = VinylFences::model();
        $materials = innerGetQueryResult($model,$networkType,$search.$siteID);
        if(!empty($materials)){
            foreach ($materials as $key=>$material){
                $material['type_of_fence'] = 'Vinyl';
                $fences[$i] = $material;
                $i++;
            }
        }
	    
        $model = WoodFences::model();
        $materials = innerGetQueryResult($model,$networkType,$search,$siteID);
        if(!empty($materials)){
            foreach ($materials as $key=>$material){
                $material['type_of_fence'] = 'Wood';
                $fences[$i] = $material;
                $i++;
            }
        }
	    
        $model = ChainlinkFences::model();
	    $materials = innerGetQueryResult($model,$networkType,$search,$siteID);
        if(!empty($materials)){
            foreach ($materials as $key=>$material){
                $material['type_of_fence'] = 'Chainlink';
                $fences[$i] = $material;
                $i++;
            }
        }
	    
	    return $fences;
	}
	
	public function getFenceByAdvanceQuery($data,$networkType,$siteID){		
		
		$fences = array();
		$i = 0;
		
		if(!isset($data['type'])){
		    $data['type'][] = 'AluminumFences';
		    $data['type'][] = 'VinylFences';
		    $data['type'][] = 'WoodFences';
		    $data['type'][] = 'ChainlinkFences';
		} else if(empty($data['type'][0]) && empty($data['type'][1])){
		    $data['type'][] = 'AluminumFences';
		    $data['type'][] = 'VinylFences';
		    $data['type'][] = 'WoodFences';
		    $data['type'][] = 'ChainlinkFences';
		}
		
		if(isset($data['assign_categories'])){
		    if($data['assign_categories']=='Privacy'){
		        $data['privacy'][] = 'Privacy';
		        unset($data['assign_categories']);
		    }
		}
		
		if(in_array('AluminumFences', $data['type'])){
		    $materials = $this->searchAluminumFencesQuery($data,$networkType,$siteID);
		    if(!empty($materials)){
    		    foreach ($materials as $key=>$material){
    		        $material['type_of_fence'] = 'Aluminum';
    		        $fences[$i] = $material;
    		        $i++;
    		    }
		    }
		}
		
		if(in_array('VinylFences', $data['type'])){
		    $materials = $this->searchVinylFencesQuery($data,$networkType,$siteID);
		    if(!empty($materials)){
    		    foreach ($materials as $key=>$material){
    		        $material['type_of_fence'] = 'Vinyl';
    		        $fences[$i] = $material;
    		        $i++;
    		    }
		    }
		}
		
		if(in_array('WoodFences', $data['type'])){
		    $materials = $this->searchWoodFencesQuery($data,$networkType,$siteID);		    
		    if(!empty($materials)){
    		    foreach ($materials as $key=>$material){
    		        $material['type_of_fence'] = 'Wood';
    		        $fences[$i] = $material;
    		        $i++;
    		    }
		    }
		}
		
		if(in_array('ChainlinkFences', $data['type'])){
		    $materials = $this->searchChainlinkFencesQuery($data,$networkType,$siteID);
		    if(!empty($materials)){
    		    foreach ($materials as $key=>$material){
    		        $material['type_of_fence'] = 'Chainlink';
    		        $fences[$i] = $material;
    		        $i++;
    		    }
		    }
		}
		
		return $fences;		
	}
	
	public function searchAluminumFencesQuery($data,$networkType,$siteID){
        $fenceObj = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('aluminum_fences');
        
        $fenceObj->where('network_type=:networkType AND is_hide=:isHide AND store_id=:siteID',array(':networkType'=>$networkType,':isHide'=>0,':siteID'=>$siteID));        
        if(isset($data['privacy']) && ($data['privacy']!='')){
            $q = $data['privacy'];
            $fenceObj->andWhere(array('in','fence_style',$q));
        }
        
        if(isset($data['min_height']) && ($data['min_height']!='')){
            
            $maxH = $data['max_height'];
            $minH = $data['min_height'];
            
            if(($minH == $maxH) && $minH==0){
        
            } else if(($minH == $maxH) && $minH!=0) {
                $fenceObj->andWhere('height=:height',array(':height'=>$maxH));
            } else {
                $fenceObj->andWhere('height BETWEEN '.$minH.' AND '.$maxH);
            }
            //$fenceObj->andWhere(array('between','height',array($minH,$maxH)));
        }
        
        if(isset($data['width']) && ($data['width']!='')){
            $q = $data['width'];
            $fenceObj->andWhere(array('in','width',$q));
        }
        
        if(isset($data['color']) && ($data['color']!='')){
            $q = $data['color'];
            $fenceObj->andWhere(array('in','color',$q));
        }
        
        if(isset($data['section_mount']) && ($data['section_mount']!='')){
            $q = $data['section_mount'];
            $fenceObj->andWhere(array('and','section_mount="'.$q.'"'));
        }
        
        if(isset($data['assign_categories']) && ($data['assign_categories']!='')){
            $q = $data['assign_categories'];
            $fenceObj->andWhere(array('like','assign_categories','%'.$q.'%'));
        }
        $fenceObj->order='system_name';
        $fences =  $fenceObj->queryAll();
        
        return $fences;
	}
	
	public function searchVinylFencesQuery($data,$networkType,$siteID){
	    $fenceObj = Yii::app()->db->createCommand()
            	    ->select('*')
            	    ->from('vinyl_fences');
	
	    $fenceObj->where('network_type=:networkType AND is_hide=:isHide AND store_id=:siteID',array(':networkType'=>$networkType,':isHide'=>0,':siteID'=>$siteID));
	    if(isset($data['privacy']) && ($data['privacy']!='')){
	        $q = $data['privacy'];
	        $fenceObj->andWhere(array('in','fence_style',$q));
	    }
	
	    if(isset($data['min_height']) && ($data['min_height']!='')){
	        
	        $maxH = $data['max_height'];
	        $minH = $data['min_height'];
	        
	        if(($minH == $maxH) && $minH==0){
	
	        } else if(($minH == $maxH) && $minH!=0) {
	            $fenceObj->andWhere('height=:height',array(':height'=>$maxH));
	        } else {
	            $fenceObj->andWhere('height BETWEEN '.$minH.' AND '.$maxH);
	        }
	        //$fenceObj->andWhere(array('between','height',array($minH,$maxH)));
	    }
	
	    if(isset($data['width']) && ($data['width']!='')){
	        $q = $data['width'];
	        $fenceObj->andWhere(array('in','width',$q));
	    }
	
	    if(isset($data['color']) && ($data['color']!='')){
	        $q = $data['color'];
	        $fenceObj->andWhere(array('in','color',$q));
	    }
	    
	    if(isset($data['section_mount']) && ($data['section_mount']!='')){
	        $q = $data['section_mount'];
	        $fenceObj->andWhere(array('and','section_mount="'.$q.'"'));
	    }
	    
	    if(isset($data['assign_categories']) && ($data['assign_categories']!='')){
	        $q = $data['assign_categories'];
	        $fenceObj->andWhere(array('like','assign_categories','%'.$q.'%'));
	    }
        $fenceObj->order='system_name';
	    $fences =  $fenceObj->queryAll();
	
	    return $fences;
	}
	
	public function searchWoodFencesQuery($data,$networkType,$siteID){
	    $fenceObj = Yii::app()->db->createCommand()
            	    ->select('*')
            	    ->from('wood_fences');
	
	    $fenceObj->where('network_type=:networkType AND is_hide=:isHide AND store_id=:siteID',array(':networkType'=>$networkType,':isHide'=>0,':siteID'=>$siteID));
	    if(isset($data['privacy']) && ($data['privacy']!='')){
	        $q = $data['privacy'];
	        $fenceObj->andWhere(array('in','fence_style',$q));
	    }
	
	    if(isset($data['min_height']) && ($data['min_height']!='')){
	        
	        $maxH = $data['max_height'];
	        $minH = $data['min_height'];
	        
	        if(($minH == $maxH) && $minH==0){
	
	        } else if(($minH == $maxH) && $minH!=0) {
	            $fenceObj->andWhere('height=:height',array(':height'=>$maxH));
	        } else {
	            $fenceObj->andWhere('height BETWEEN '.$minH.' AND '.$maxH);
	        }
	        //$fenceObj->andWhere(array('between','height',array($minH,$maxH)));
	    }
	
	    if(isset($data['width']) && ($data['width']!='')){
	        $q = $data['width'];
	        $fenceObj->andWhere(array('in','width',$q));
	    }
	
	    if(isset($data['color']) && ($data['color']!='')){
	        $q = $data['color'];
	        $fenceObj->andWhere(array('in','color',$q));
	    }
	    
	    /* if(isset($data['section_mount']) && ($data['section_mount']!='')){
	        $q = $data['section_mount'];
	        $fenceObj->andWhere(array('and','section_mount="'.$q.'"'));
	    } */
	    
	    if(isset($data['assign_categories']) && ($data['assign_categories']!='')){
	        $q = $data['assign_categories'];
	        $fenceObj->andWhere(array('like','assign_categories','%'.$q.'%'));
	    }
        $fenceObj->order='system_name';
	    $fences =  $fenceObj->queryAll();
	
	    return $fences;
	}
	
	public function searchChainlinkFencesQuery($data,$networkType,$siteID){
	    $fenceObj = Yii::app()->db->createCommand()
            	    ->select('*')
            	    ->from('chainlink_fences');
	
	    $fenceObj->where('network_type=:networkType AND is_hide=:isHide AND store_id=:siteID',array(':networkType'=>$networkType,':isHide'=>0,':siteID'=>$siteID));
	    /* if(isset($data['privacy']) && ($data['privacy']!='')){
	        $q = $data['privacy'];
	        $fenceObj->andWhere(array('in','fence_style',$q));
	    } */
	
	    if(isset($data['min_height']) && ($data['min_height']!='')){
	        //$q = $data['height'];
	        $maxH = $data['max_height'];
	        $minH = $data['min_height'];
	        //echo $minH .' '.$maxH;
	        if(($minH == $maxH) && $minH==0){
	
	        } else if(($minH == $maxH) && $minH!=0) {
	            $fenceObj->andWhere('height=:height',array(':height'=>$maxH));
	        } else {
	            $fenceObj->andWhere('height BETWEEN '.$minH.' AND '.$maxH);
	        }
	        //$fenceObj->andWhere(array('between','height',array($minH,$maxH)));
	    }
	
	    if(isset($data['width']) && ($data['width']!='')){
	        $q = $data['width'];
	        $fenceObj->andWhere(array('in','width',$q));
	    }
	
	    if(isset($data['color']) && ($data['color']!='')){
	        $q = $data['color'];
	        $fenceObj->andWhere(array('in','color',$q));
	    }
	    
	    /* if(isset($data['section_mount']) && ($data['section_mount']!='')){
	        $q = $data['section_mount'];
	        $fenceObj->andWhere(array('and','section_mount="'.$q.'"'));
	    } */
	    
	    if(isset($data['assign_categories']) && ($data['assign_categories']!='')){
	        $q = $data['assign_categories'];
	        $fenceObj->andWhere(array('like','assign_categories','%'.$q.'%'));
	    }
        $fenceObj->order='system_name';
	    $fences =  $fenceObj->queryAll();
	
	    return $fences;
	}
	
	public function getFenceBySingleQuery($data){
		if(isset($data['search']) && ($data['search']!='')){
			$s = $data['search'];
			$fences = Fences::model()->findAll('name=:name OR description=:description',array(':name'=>$s, ':description'=>$s));			
			
			return $fences;
			
		}else {
			return false;
		}
	}
	
	public function checkUserEmail($email){
		$result = Users::model()->findAll('user_email=:email',array(':email'=>$email));
		if(!empty($result)){
			return true;
		} else {
			return false;
		}
	}
        public function checkUsername($username) {
            $result = Users::model()->findAll('login_name=:loginName',array(':loginName'=>$username));
            if(!empty($result)){
                return true;
            } else {
                return false;
            }
        }
	
	public function getMaterialsType(){
	    $materials = array(
	        'AluminumFences' => 'Aluminum',
	        'ChainlinkFences' => 'Chainlink',
	        'VinylFences' => 'Vinyl',
	        'WoodFences' => 'Wood',
	    );
	    
	    return $materials;
	}
	
	public function getGroupMaterials($fenceType,$fenceId,$siteID){
	    $data = array();
	     
	    function innerGetGroupMaterials($model,$fenceId,$siteID){
	        return Yii::app()->db->createCommand()
        	        ->select('*')
        	        ->from($model->tableName())
        	        ->where('group_material_id=:ID AND is_blank=:isBlank AND store_id=:siteID',array(':ID'=>$fenceId,':isBlank'=>0,':siteID'=>$siteID))
        	        ->queryAll();
	    }
	     
	    if(strtolower($fenceType) == 'aluminum') {
	        $model = AluminumFences::model();
	        $data = innerGetGroupMaterials($model,$fenceId,$siteID);
	        $i = 0;
	        while ($i < count($data)){
	            $data[$i]['type_of_fence'] = 'aluminum';	            
	            $i++;
	        }
	    } else if (strtolower($fenceType) == 'chainlink') {
	        $model = ChainlinkFences::model();
	        $data = innerGetGroupMaterials($model,$fenceId,$siteID);
	        $i = 0;
	        while ($i < count($data)){
	            $data[$i]['type_of_fence'] = 'chainlink';
	            $i++;
	        }	         
	    } else if (strtolower($fenceType) == 'vinyl') {
	        $model = VinylFences::model();
	        $data = innerGetGroupMaterials($model,$fenceId,$siteID);
	        $i = 0;
	        while ($i < count($data)){
	            $data[$i]['type_of_fence'] = 'vinyl';
	            $i++;
	        }	         
	    } else if (strtolower($fenceType) == 'wood') {
	        $model = WoodFences::model();
	        $data = innerGetGroupMaterials($model,$fenceId,$siteID);
	        $i = 0;
	        while ($i < count($data)){
	            $data[$i]['type_of_fence'] = 'wood';
	            $i++;
	        }	    
	    }
	     
	    return $data;
	}
	
	public function getSelectedMaterial($fenceType,$fenceId){
	    $data = array();
	    
	    function innerGetQueryResult($model,$fenceId){
	        return Yii::app()->db->createCommand()
        	        ->select('*')
                    ->from($model->tableName())
                    ->where('id=:ID',array(':ID'=>$fenceId))
                    ->queryRow();
	    }
	    
	    if(strtolower($fenceType) == 'aluminum') {
	        $model = AluminumFences::model();
	        $data = innerGetQueryResult($model,$fenceId);
	        
	    } else if (strtolower($fenceType) == 'chainlink') {
	        $model = ChainlinkFences::model();
	        $data = innerGetQueryResult($model,$fenceId);
	        
	    } else if (strtolower($fenceType) == 'vinyl') {
	        $model = VinylFences::model();
	        $data = innerGetQueryResult($model,$fenceId);
	        
	    } else if (strtolower($fenceType) == 'wood') {
	        $model = WoodFences::model();
	        $data = innerGetQueryResult($model,$fenceId);
	        	        
	    }
	    
	    return $data;
	}
	
	public function getUserData($user_id){
	    $model = Users::model();
	    $data = Yii::app()->db->createCommand()
        	    ->select('*')
        	    ->from($model->tableName())
        	    ->where('id=:ID',array(':ID'=>$user_id))
        	    ->queryRow();
	    
	    return $data;
	}
	
	public function getStoreData($store_id){
	    $model = Sites::model();
	    $data = Yii::app()->db->createCommand()
        	    ->select('*')
        	    ->from($model->tableName())
        	    ->where('store_id=:ID',array(':ID'=>$store_id))
        	    ->queryRow();
	    
	    return $data;
	}
	
	public function getMaterialGate($fenceType,$fenceId,$networkType){
	    $model = array();
	    
	    $model = Gates::model()->findAll('material=:material AND material_id=:material_id AND network_type=:networkType',array(':material'=>strtolower($fenceType),':material_id'=>$fenceId, ':networkType'=>$networkType));
	    
	    return $model;
	}
	
	public function getMaterialPostCaps($fenceType,$fenceId,$networkType){
	    $model = array();
	     
	    $model = PostCaps::model()->findAll('material=:material AND material_id=:material_id AND network_type=:networkType',array(':material'=>strtolower($fenceType),':material_id'=>$fenceId, ':networkType'=>$networkType));
	     
	    return $model;
	}
	
	public function getMaterialGateLatchOptions($fenceType,$fenceId,$networkType){
	    $model = array();
	    	     
	    $model = GateLatchOptions::model()->findAll('material=:material AND material_id=:material_id AND network_type=:networkType',array(':material'=>strtolower($fenceType),':material_id'=>$fenceId, ':networkType'=>$networkType));
	     
	    return $model;
	}
	
	public function getMaterialCategories($siteID){
	    $model = Sites::model();
	    $data = Yii::app()->db->createCommand()
        	    ->select('category_list')
        	    ->from($model->tableName())
        	    ->where('id=:ID',array(':ID'=>$siteID))
        	    ->queryRow();
	    //if(!empty($data['category_list'])){
	        return explode(',', $data['category_list']);
	    //} else {
	    //    return 0;
	    //}
	}
	
	public function updateQuoteForPayment($quote_id,$fullPayment,$store_id){
	    $partialAmmount = 0;
	    $store = Sites::model()->find('store_id=:ID',array(':ID'=>$store_id));
	    $quote = Quotes::model()->findByPk($quote_id);
	    //$this->prd($store);
	    
	    if($store->payment_type == 'percent'){
	        $partialAmmount = $fullPayment * ( $store->payment_amount/100 );
	    } else if($store->payment_type=='percent') {
	        $partialAmmount = $store->payment_amount;
	    }
	    
	    $quote->upfront_payment = $partialAmmount;
	    $quote->full_payment = $fullPayment;
	    
	    $quote->save();
	}
		
}