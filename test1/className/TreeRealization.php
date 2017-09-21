<?php
include 'Tree.php';
include 'Node.php';

class TreeRealization extends Tree
{
    private $tree;
    
    public function getNode($nodeName) {
        if($this->tree[0]['root']->getName() == $nodeName){
            $node = $this->tree[0]['root'];
            return $node;
        }else{
            $node = &$this->findNode($this->tree[0]['childs'],$nodeName); 
            return $node['node'];
        }        
    }
	
    public function &findNode(&$nodes,$nodeName){
        foreach($nodes as &$node){
            if($node){
            if($node['node']->getName() == $nodeName){
                $findNode = &$node;  
                break;
            }elseif(isset($node['childs'])) {
               $findNode = &$this->findNode($node['childs'],$nodeName);
            }          
        }
        
            } return $findNode;  
       
    }	
	
	public function createNode(Node $node,$parentNode=NULL) {
        if ($parentNode == NULL){
            $this->tree[0]['root'] = $node;
        }elseif($parentNode == $this->tree[0]['root']){
             $this->tree[0]['childs'][]['node'] = $node;
        }else{
          $peaceTree = &$this->findNode($this->tree[0]['childs'],$parentNode->getName());
          $peaceTree['childs'][]['node'] = $node;
        }
    }
    
    public function deleteNode(Node $node) {
        $delNode = &$this->findNode($this->tree[0]['childs'],$node->getName());
        $delNode = NULL;
       // $this->findIndex($this->tree[0]['childs'], $node->getName());
    }
   
    public function attachNode(Node $node,Node $parent) {
       $attachNode = $this->findNode($this->tree[0]['childs'],$node->getName());
       $this->deleteNode($node);
       $newParent = &$this->findNode($this->tree[0]['childs'],$parent->getName());
       $newParent['childs'][] = $attachNode;     
    }

    public function export() { 
        $exportArray;
        $exp = &$this->buildTree($this->tree[0]['childs'],$exportArray[$this->tree[0]['root']->getName()]);
        return $exportArray;
    }
    
    public function &buildTree($nodes,&$export) {
         foreach($nodes as $node){
            if($node){
            if(isset($node['childs'])) {
               $findNode = $this->buildTree($node['childs'],$export[$node['node']->getName()]);
            }else{
                $export[$node['node']->getName()] = '';
            }      
        }
        
            } return $findNode;
    }
}

