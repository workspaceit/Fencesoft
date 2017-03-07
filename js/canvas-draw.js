var _ObjectList = new Array();//store object 

/**
 * gemerate unique id
 */
var uniqueID = (function() {
   	return '_' + Math.random().toString(36).substr(2, 9);
});

stage  = '';
$(function(){   
	
    var _isNewline = false;
    var _prevX = -1;
    var _prevY = -1;
    var _prevLine = 0;
    var _prevPointId = '';
   
    var layer = '';
    var drawPage = '';
    
    /** Draw Canvas**/
    if(_QuotesData.length > 0) {
    	stage = Kinetic.Node.create(_QuotesData, 'canvas-container');
    	var gridScale = stage.getAttr('gridScale');
    	
    	if(gridScale){
    		$('#drawing_grid_length').val(gridScale);
    	} else {
    		$('#drawing_grid_length').val(100);
    	}
    	
    	drawPage = stage.get('#drawPage');
    	layer = stage.get('#mainLayer')[0];
    	
    	stage.find('.circle').on('mouseover', function(evt) {
			this.setAttrs({
				radius: 6,
			});
			layer.drawScene();				
		});

		stage.find('.circle').on('mouseout', function(evt) {
			this.setAttrs({
				radius: 4,
			});
			layer.drawScene();				
		});
		
		stage.find('.circle').on('mouseout', function(evt) {
			this.setAttrs({
				radius: 4,
			});
			layer.drawScene();				
		});
		
		stage.find('.circle').on('dragmove', function(evt) {			
        	updateLineInfo(this,evt.layerX,evt.layerY);
            layer.drawScene();
        });
       
		stage.find('.circle').on('dragend', function(evt) {
            var nid = this.getId();
            var nodeX = evt.layerX;
            var nodeY = evt.layerY;
           
            /** check over circle or not and update*/
            var circleObjArr = layer.find('.circle');
            var isDropped = '';
            isDropped = $.map(circleObjArr,function(e,i){           
                if( nodeX > (e.getX() - e.getWidth()/2) && nodeX < (e.getX() + e.getWidth()/2) &&
                    nodeY > (e.getY() - e.getHeight()/2) && nodeY < (e.getY() + e.getHeight()/2) &&
                    (nid != e.getId())
                  ) {
                    return e.getId();               
                } 
            });
            
            if(isDropped.length > 0){
            	combineLineAndUpdate(isDropped,nid);                
                this.remove();
                this.destroy();
            } else {            	
            	updateLineInfo(this,nodeX,nodeY);              
                
                this.setAttrs({
                    x: nodeX,
                    y: nodeY,
                });
            }       
            
            layer.draw();
        });
        
		stage.find('.circle').on('dblclick dbltap', function(evt) {
        	/*var btnHtml = $('#node-remove-content').html();
        	$('#canvas-container').append(btnHtml);
        	$('#canvas-container').find('.node-remove-content').css({
        		'position' : 'absolute',
        		'top' : evt.clientX,
        		'left' : evt.clientY,
        	});*/
        });
		
		stage.find('.dropGate').on('dblclick',function(evt){
			var line = layer.find('#'+this.getAttr('lineId'))[0];
			var lineGateIdList = line.getAttr('gateIdList');
			lineGateIdList.removeByValue(this.getId());
			line.setAttr('gateIdList',lineGateIdList);
			
	    	redrawGate((this.getPoints()[0].x+this.getPoints()[1].x)/2,(this.getPoints()[0].y+this.getPoints()[1].y)/2-5,this.getAttr('gateInfo'));
	    	
	    	layer.find('#'+this.getAttr('endPointA'))[0].destroy();
			layer.find('#'+this.getAttr('endPointB'))[0].destroy();
			
	    	this.destroy();
	    	
	    	layer.drawScene();
	    	calculateLineSublabel(line.getId());
		});
		
		stage.find('.gate_end_point').on('click',function(evt){
			repositionGate(this.getId());
		});
		
		stage.find('.structure').on('click', function(evt) {
    		var stID = this.getId();
    		var node = layer.find('#'+stID)[0];
    		var pNode = node.getParent();
    		
           if(node.getAttr('toggleClick')==true) {
        	   
        	   node.setAttr('toggleClick', false);
        	   node.setAttrs({
        		   stroke : 'transparent',
        		   strokeWidth : 2
        	   });
        	   pNode.find('.topLeft').hide();
        	   pNode.find('.topRight').hide();
        	   pNode.find('.bottomRight').hide();
        	   pNode.find('.bottomLeft').hide();
           } else {
        	   node.setAttr('toggleClick', true);
        	   node.setAttrs({
        		   stroke : 'gray',
        		   strokeWidth : 2
        	   });
        	   pNode.find('.topLeft').show();
        	   pNode.find('.topRight').show();
        	   pNode.find('.bottomRight').show();
        	   pNode.find('.bottomLeft').show();
           }
           layer.draw();
    	});
    	
		stage.find('.structure').on('dblclick',function(){
    		this.getParent().destroy();
    		layer.drawScene();
    	});
    	
		stage.find('.imgNav').on('dragstart', function() {
            this.moveToTop();
        });
		
		var anchorActivity = function(anchor){
			stage.find('.'+anchor).on('dragmove', function() {				
	        	updateImage(this);
	        	layer.draw();
	        });
	        
			stage.find('.'+anchor).on('mousedown touchstart', function() {
				this.getParent().setDraggable(false);
				this.moveToTop();
	        });
	        
			stage.find('.'+anchor).on('dragend', function() {
				this.getParent().setDraggable(true);
				layer.draw();
	        });
	        
	        // add hover styling
			stage.find('.'+anchor).on('mouseover', function() {	        
	          document.body.style.cursor = 'pointer';
	          this.setStrokeWidth(5);
	          layer.draw();
	        });
	        
	        stage.find('.'+anchor).on('mouseout', function() {	          
	          document.body.style.cursor = 'default';
	          this.setStrokeWidth(2);
	          layer.draw();
	        });
		};
		
		anchorActivity('topLeft');
		anchorActivity('topRight');
		anchorActivity('bottomRight');
		anchorActivity('bottomLeft');
    	
    } else {
    	stage = new Kinetic.Stage({
            container: 'canvas-container',
            width: 800,
            height: 600
        });
    	
    	/** Draw Graph**/
        var graph = drawGraph(stage.getHeight(), stage.getWidth());
       
        /** Draw Layer**/
        layer = new Kinetic.Layer({
        	name : 'layer',
        	id : 'mainLayer'
        });
       
        /** Page for draw**/
        drawPage = new Kinetic.Rect({
              width: stage.getWidth(),
              height: stage.getHeight(),
              id : 'drawPage',
              fill : 'transparent',
              strokeWidth : '2',
              strokeRGB : { r:204 ,g:204 , b:204 }
        });
        
        layer.add(graph);
        layer.add(drawPage);   
        stage.add(layer);
    }
      
    /**Double click mouse events**/
    drawPage.on('dblclick dbltap', function(evt) {
    	_isDrawing = true;
        if(!_isNewline){
        	_isNewline = true;
            _prevX = evt.layerX;
            _prevY = evt.layerY;
            _prevPointId = drawPoint(layer, _prevX,_prevY);//draw first point 
        } else {
            if(_prevLine){
                _prevLine.destroy();
                layer.find('#'+_prevLine.getAttr('label'))[0].destroy();
                _prevLine = 0;                
            }
            var nid = drawPoint(layer, evt.layerX, evt.layerY);//draw second point
            
            var line = drawLine(layer, _prevX, _prevY, evt.layerX, evt.layerY);            
            
            var pointObj = layer.find('#'+_prevPointId)[0];            
            pointObj.setAttr('lines',[line.getId()]);
            pointObj.setAttr('adjNode',[nid]);
                        
            pointObj = layer.find('#'+nid)[0];
            pointObj.setAttr('lines',[line.getId()]);
            pointObj.setAttr('adjNode',[_prevPointId]);
                        
            line.setAttr('nodeA',{id:_prevPointId, x:_prevX, y:_prevY});
            line.setAttr('nodeB',{id:nid,x:evt.layerX,y:evt.layerY});
                        
            prevX = prevY = -1;
            _prevPointId = '';
            _isNewline = false;
            _ObjectList.push({'type' : 'line', 'Obj' : line});
        }
    });
   
    drawPage.on('mousemove touchmove', function(evt) {
        if(_isNewline){
            if(_prevLine){
                _prevLine.destroy();
                layer.find('#'+_prevLine.getAttr('label'))[0].destroy();
            }
            _prevLine = drawLine(layer, _prevX, _prevY, evt.layerX, evt.layerY);
        }       
    });
    
    
    /**Canvas background color**/
    $('#canvas-container canvas').css('background','#eee');

    /**
     * Draw Line function
     */
    var drawLine = function(layer,x1, y1,x2,y2){
        var line = new Kinetic.Line({
            points: [x1,y1,x2,y2],
            fill : 'black',
            stroke: 'black',
            id : 'line'+uniqueID(),
            name : 'fence-line',
            lineCap : 'round',
            width : 3,
            strokeWidth: 2,
        });        

        var lineLabel = new Kinetic.Label({
            x: (x1+x2)/2,
            y: (y1+y2)/2,
            id : 'mainlabel_'+line.getId(),
            opacity: 1,
        });
        
        
        
        linePoint = { x1:x1, x2:x2, y1:y1, y2:y2 };
        
        lineLabel.add(new Kinetic.Tag({
            fill: 'white',
            pointerDirection: setDirection(linePoint),
            pointerWidth: 10,
            pointerHeight: 10,
            lineJoin: 'round',
            shadowColor: 'black',
            shadowBlur: 5,
            shadowOffset: 5,
            shadowOpacity: 0.5
        }));
        lineLabel.add(new Kinetic.Text({
            text: calculateLineLength(linePoint),
            fontFamily: 'Calibri',
            fontSize: 14,
            padding: 2,
            fill: 'black'
        }));
        
        line.setAttr("nodeA",{id:'',x:'',y:''});
        line.setAttr("nodeB",{id:'',x:'',y:''});
        line.setAttr("gateIdList",[]);
        line.setAttr("sublabelClass",'sublabel_'+line.getId());
        line.setAttr("label",lineLabel.getId());
        line.setAttr("isGate",false);
                
        layer.add(line);
        layer.add(lineLabel);
        layer.drawScene();
       
        return line;
    };
    
     var setDirection = function(linePoint){
         var slope = findSlope(linePoint.x1,linePoint.y1,linePoint.x2,linePoint.y2);
         var direction="";
         if(linePoint.y1<40 && linePoint.y2<40){
            direction='up';
            
        }else if(linePoint.x1<40 && linePoint.x2<40){
           direction='left';
        }else if(linePoint.x1>730 && linePoint.x2>730){
           direction='right';
        }
        else if(linePoint.y1>540 && linePoint.y2>540){
           direction='down';
        }else if(slope<(-1)){
            direction='left';
        }else if(slope<1){
            direction='down';
        }else{
            direction='left';
        }
        return direction;
     };
   
    var setLineLabel = function(labelClass,x1,y1,x2,y2){
    	
    	if(Math.round(calculateLineDistance(x1,y1,x2,y2)/getPerFeetInPixel())==0) return;
		
		var lineLabel = new Kinetic.Label({
			id : 'subLabel'+uniqueID(),
            name : labelClass,
            x: (x1 + x2)/2,
            y: (y1 + y2)/2,
            opacity: 1
        });
        linePoint = { x1:x1, x2:x2, y1:y1, y2:y2 };
        lineLabel.add(new Kinetic.Tag({
            fill: 'white',            
            pointerDirection: setDirection(linePoint),
            pointerWidth: 10,
            pointerHeight: 10,
            lineJoin: 'round',
            shadowColor: 'black',
            shadowBlur: 5,
            shadowOffset: 5,
            shadowOpacity: 0.5
        }));
        
        
        lineLabel.add(new Kinetic.Text({
            text: calculateLineLength(linePoint),
            fontFamily: 'Calibri',
            fontSize: 14,
            padding: 2,
            fill: 'black'
        }));
        
        layer.add(lineLabel);        
	};
    
    /**
     * Calculation length between line and gate
     */
    var calculateLineSublabel = function(lineId) {
    	var lineObj = layer.find('#'+lineId)[0];    	
    	var pastLabel = layer.find('.'+lineObj.getAttr('sublabelClass'));
    	for(var i=0; i < pastLabel.length; i++) {    		
    		pastLabel[i].destroy();    		
    	}
    	var lineGateIdList = lineObj.getAttr('gateIdList');
    	if(lineGateIdList.length == 0) {
    		lineObj.setAttr('isGate',false);
    		var lineLabel = layer.find('#'+lineObj.getAttr('label'))[0];
    		lineLabel.setAttr('visible',true);
    		
    		layer.drawScene();
    		return;
    	} else if(lineGateIdList.length == 1){
    		lineObj.setAttr('isGate',true);
    		var lineLabel = layer.find('#'+lineObj.getAttr('label'))[0];
    		lineLabel.setAttr('visible',false);    		  		
    	}
    	
    	var pointsArr = new Array();
    	pointsArr.push({x:lineObj.getPoints()[0].x, y:lineObj.getPoints()[0].y});
    	pointsArr.push({x:lineObj.getPoints()[1].x, y:lineObj.getPoints()[1].y});
    	
    	for(var i = 0; i < lineGateIdList.length; i++){    		
    		var gateObj = layer.find('#'+lineGateIdList[i]);
    		
    		if(!$.isEmptyObject(gateObj)){    			
    			pointsArr.push({x:gateObj[0].attrs.points[0].x, y:gateObj[0].attrs.points[0].y});
    			pointsArr.push({x:gateObj[0].attrs.points[1].x, y:gateObj[0].attrs.points[1].y});
    		} 
    	}
    	
    	if(lineObj.getPoints()[0].x == lineObj.getPoints()[1].x){
    		pointsArr.sort(function(a,b){
        		return a.y - b.y;
        	});
    	} else {
    		pointsArr.sort(function(a,b){
    			return a.x - b.x;
        	});
    	}
    	
    	for(var i = 0; i < pointsArr.length-1; i= i+1){
    		setLineLabel(lineObj.getAttr('sublabelClass'),pointsArr[i].x,pointsArr[i].y,pointsArr[i+1].x,pointsArr[i+1].y);
    	}
    	
    	layer.draw();
    	
    };
    
    /**
     * Redraw Gate
     */
    var redrawGate = function(xpos,ypos,gateInfo){
    	var rect = new Kinetic.Rect({
    		x: xpos,
            y: ypos,
            width: 40,
            height: 20,
            name : 'undropGate',
            id : 'undrop'+uniqueID(),
            fillRGB: { r:56, g:142, b:142 },
            strokeRGB : { r:47, g:79, b:79 },            
            draggable : true,
        });
        
        rect.on('mouseover',function(){            
            document.body.style.cursor = 'pointer';
            layer.drawScene();
        });   
       
        rect.on('mouseout',function(){            
            document.body.style.cursor = 'default';
            layer.drawScene();
        });
        
        rect.on('dragend',function(evt){    	
            
            var X = this.getX(),
                Y = this.getY(),
                W = this.getWidth(),
                H = this.getHeight();
            
            var intersectObj = checkGateDropOveLine(X,Y,W,H);
            
            if(intersectObj.hasOwnProperty('iPoints')){
            	if(intersectObj.iPoints.length==2){
            		updateLineAfterGateDrop(this.gateInfo,intersectObj);            		
            		this.remove();
            		this.destroy();
                }
            }
            layer.draw();
        });
        
        rect.on('dblclick',function(evt){    	
            this.destroy();
            layer.draw();
        });
        
        rect.gateInfo = gateInfo;
        
        layer.add(rect);
        layer.draw();
    };
    
    /**
     * Draw Gate
     */
    var drawGate = function(gatePoints,lineObj,gateCenter,gateInfo){
    	
    	var kLine = lineObj.line;
    	var rgb = { r : 0, g: 112, b: 60 };
    	if(gateInfo.gate_type == 'double'){
    		rgb = { r : 69, g: 149, b: 88 };
    	}
    	
		var gate = new Kinetic.Line({
            points: [gatePoints.x1, gatePoints.y1, gatePoints.x2, gatePoints.y2],
            fillRGB: rgb,
            strokeRGB: rgb,
            id : 'gate'+uniqueID(),
            name : 'dropGate',
            width : 3,
            strokeWidth: 15,            
        });
		
		gate.on('dblclick', function(evt) {
			var line = layer.find('#'+this.getAttr('lineId'))[0];
			line.getAttr('gateIdList').removeByValue(this.getId());
			
			layer.find('#'+this.getAttr('endPointA'))[0].destroy();
			layer.find('#'+this.getAttr('endPointB'))[0].destroy();
			
	    	redrawGate((this.getPoints()[0].x+this.getPoints()[1].x)/2,(this.getPoints()[0].y+this.getPoints()[1].y)/2-5,this.getAttr('gateInfo'));
	    	
	    	this.destroy();
	    	
	    	layer.draw();
	    	calculateLineSublabel(line.getId());
	    	
	    });
		
		var pointA = new Kinetic.Circle({
			x: gatePoints.x1,
            y: gatePoints.y1,
            radius: 4,
            name : 'gate_end_point',
            id: 'gate_end_point'+uniqueID(),
            fill: 'black',
            stroke: 'black',
            strokeWidth: 1,
		});
		
		var pointB = new Kinetic.Circle({
			x: gatePoints.x2,
            y: gatePoints.y2,
            radius: 4,
            name : 'gate_end_point',
            id: 'gate_end_point'+uniqueID(),
            fill: 'black',
            stroke: 'black',
            strokeWidth: 1,
		});
		
		pointA.setAttrs({
			'gateId' : gate.getId(),
			'lineId' : kLine.getId(),
		});
		
		pointA.on('click',function(){
			repositionGate(this.getId());
		});
		
		pointB.setAttrs({
			'gateId' : gate.getId(),
			'lineId' : kLine.getId(),
		});
		
		pointB.on('click',function(){
			repositionGate(this.getId());
		});
		
		gate.setAttrs({
			'gatePosition' : {x : gateCenter.x, y : gateCenter.y},
			'lineId' : kLine.getId(),
			'gateInfo' : gateInfo,
			'endPointA' : pointA.getId(),
			'endPointB' : pointB.getId(),
		});
		
		lineGateIdList = kLine.getAttr('gateIdList');
		lineGateIdList.push(gate.getId());
		kLine.setAttr('gateIdList',lineGateIdList);		
    	
		layer.add(gate);
		layer.add(pointA);
		layer.add(pointB);
    	layer.draw();
    	
    	calculateLineSublabel(kLine.getId());
    	
    	_ObjectList.push({'type':'gate', 'Obj' : gate});
    };
    
    /**
     * Repostion gate
     */
    var repositionGate = function(pointId){
    	var pointObj = layer.find('#'+pointId)[0];
    	var gateObj = layer.find('#'+pointObj.getAttr('gateId'))[0];
    	var lineObject = layer.find('#'+pointObj.getAttr('lineId'))[0];
    	var pointObjA = layer.find('#'+gateObj.getAttr('endPointA'))[0];
    	var pointObjB = layer.find('#'+gateObj.getAttr('endPointB'))[0];
    	
    	var m = findSlope(lineObject.getPoints()[0].x, lineObject.getPoints()[0].y, lineObject.getPoints()[1].x, lineObject.getPoints()[1].y);
    	var c = findLineConstant(lineObject.getPoints()[0].x, lineObject.getPoints()[0].y, m);
    		
    	var cx = gateObj.getAttr('gatePosition').x , cy = gateObj.getAttr('gatePosition').y;
    	var feetPixel = getPerFeetInPixel();
    	var newPoints = new Object();
    	
    	if(m=='v'){
    		if(pointObj.getY() < cy) {
    			cy -= feetPixel;    			
    		} else {
    			cy += feetPixel;    			
    		}
    	} else if( m < 2.0 && m > -2.0) {    		
    		if(pointObj.getX() < cx) {
        		cx -= feetPixel;
        		cy = (m * cx) + c;    		
        	} else {
        		cx += feetPixel;
        		cy = (m * cx) + c;    		
        	}
    	} else {
    		if(pointObj.getY() < cy) {
        		cy -= feetPixel;
        		cx = (cy - c ) / m;    		
        	} else {
        		cy += feetPixel;
        		cx = (cy - c ) / m;  		
        	}
    	}
    	
    	newPoints = findLineCircleIntersectPoints({m : m, c : c}, {p : cx, q : cy, r : (gateObj.getAttr('gateInfo').gate_width/2) * feetPixel});
    	    	
    	var isDraw = true;
    	if(m=='v'){
    		if((Math.max(lineObject.getPoints()[0].y,lineObject.getPoints()[1].y)+(feetPixel/2)< Math.max(newPoints.y1,newPoints.y2))
    				|| (Math.min(lineObject.getPoints()[0].y,lineObject.getPoints()[1].y) > Math.min(newPoints.y1,newPoints.y2)+(feetPixel/2))) {
    			isDraw = false;
    		}
    	} else {
    		if((Math.max(lineObject.getPoints()[0].x,lineObject.getPoints()[1].x)+(feetPixel/2) < Math.max(newPoints.x1,newPoints.x2))
    				|| (Math.min(lineObject.getPoints()[0].x,lineObject.getPoints()[1].x) > Math.min(newPoints.x1,newPoints.x2)+(feetPixel/2))) {
    			isDraw = false;
    		}
    	}

    	if(isDraw){
    		gateObj.setPoints([newPoints.x1, newPoints.y1, newPoints.x2, newPoints.y2]);
        	gateObj.setAttr('gatePosition',{ x : cx , y : cy });
	    	pointObjA.setX(newPoints.x1);
	    	pointObjA.setY(newPoints.y1);
	    	pointObjB.setX(newPoints.x2);
	    	pointObjB.setY(newPoints.y2);
	    	
	    	calculateLineSublabel(lineObject.getId());    	   	
	    	
	    	layer.draw();
    	}
    };

    /**
     * Draw Point function
     */
    var drawPoint = function(layer, mouseX, mouseY){   
        
    	var circle = new Kinetic.Circle({
            x: mouseX,
            y: mouseY,
            radius: 4,
            name : 'circle',
            id: 'point'+uniqueID(),
            fill: 'black',
            stroke: 'black',
            strokeWidth: 1,
            draggable : true,
        });        
    	
        circle.setAttr("lines",[]);
        circle.setAttr("adjNode",[]);        
       
        circle.on('mouseover',function(){
            this.setAttrs({
                radius: 6,
            });
            layer.drawScene();
        });   
       
        circle.on('mouseout',function(){
            this.setAttrs({
                radius: 4,
            });
            layer.drawScene();
        });
       
        circle.on('dragmove', function(evt) {
        	updateLineInfo(this,evt.layerX,evt.layerY);
            layer.drawScene();
        });
       
        circle.on('dragend', function(evt) {
            var nid = this.getId();
            var nodeX = evt.layerX;
            var nodeY = evt.layerY;
           
            /** check over circle or not and update*/
            var circleObjArr = layer.find('.circle');
            var isDropped = '';
            isDropped = $.map(circleObjArr,function(e,i){           
                if( nodeX > (e.getX() - e.getWidth()/2) && nodeX < (e.getX() + e.getWidth()/2) &&
                    nodeY > (e.getY() - e.getHeight()/2) && nodeY < (e.getY() + e.getHeight()/2) &&
                    (nid != e.getId())
                  )
                {
                    return e.getId();               
                } 
            });
            
            if(isDropped.length > 0){
            	combineLineAndUpdate(isDropped,nid);                
                this.remove();
                this.destroy();
            } else {            	
            	updateLineInfo(this,nodeX,nodeY);              
                
                this.setAttrs({
                    x: nodeX,
                    y: nodeY,
                });
            }       
            
            layer.draw();
        });
        
        circle.on('dblclick dbltap', function(evt) {
        	/*var btnHtml = $('#node-remove-content').html();
        	$('#canvas-container').append(btnHtml);
        	$('#canvas-container').find('.node-remove-content').css({
        		'position' : 'absolute',
        		'top' : evt.clientX,
        		'left' : evt.clientY,
        	});*/
        });
       
        layer.add(circle);
        layer.draw();
        
        return circle.getId();
    };
    
    /**
     * Update after node drop another node
     */
    var combineLineAndUpdate = function(nodeA,nodeB){
    	var nodeAObj = layer.find('#'+nodeA)[0];
    	var nodeBObj = layer.find('#'+nodeB)[0];
    	
    	nodeALines = nodeAObj.getAttr('lines');
    	nodeBLines = nodeBObj.getAttr('lines');
    	
    	if(nodeBLines.length > 0){
    		$.map(nodeBLines,function(e,i){
    			nodeALines.push(e);
                var lineObj = layer.find('#'+e)[0];
                var lineNodeA = lineObj.getAttr('nodeA');
                var lineNodeB = lineObj.getAttr('nodeB');
                if(lineNodeA.id==nodeBObj.getId()){
                	lineNodeA.id = nodeAObj.getId();
                	lineNodeA.x = nodeAObj.getX();
                	lineNodeA.y = nodeAObj.getY();
                	lineObj.setAttr('nodeA',lineNodeA);
                	
                	nodeObj = layer.find('#'+lineNodeB.id)[0];
                	var nodeAdjNode = nodeObj.getAttr('adjNode');
                	nodeAdjNode.removeByValue(nodeBObj.getId());
                	nodeAdjNode.push(nodeAObj.getId());
                	nodeObj.setAttr('adjNode',nodeAdjNode);
                } else {
                	lineNodeB.id = nodeAObj.getId();
                	lineNodeB.x = nodeAObj.getX();
                	lineNodeB.y = nodeAObj.getY();
                	lineObj.setAttr('nodeB',lineNodeB);
                	
                	nodeObj = layer.find('#'+lineNodeA.id)[0];
                	var nodeAdjNode = nodeObj.getAttr('adjNode');
                	nodeAdjNode.removeByValue(nodeBObj.getId());
                	nodeAdjNode.push(nodeAObj.getId());
                	nodeObj.setAttr('adjNode',nodeAdjNode);
                }
                
                if(lineObj.getAttr('isGate')){
                	lineObj.setAttr('isGate',false);
                	var lineGateList = lineObj.getAttr('gateIdList');
                	while (lineGateList.length > 0) {
                		var gateObj = layer.find('#'+lineGateList.pop())[0];
                		layer.find('#'+gateObj.getAttr('endPointA'))[0].destroy();
                		layer.find('#'+gateObj.getAttr('endPointB'))[0].destroy();
                		gateObj.destroy();
                	}
                	lineObj.setAttr('gateIdList',[]);
                	calculateLineSublabel(e);
                }
                
                lineLable = layer.find('#'+lineObj.getAttr('label'))[0];                
                lineLable.setX((lineNodeA.x + lineNodeB.x)/2);
                lineLable.setY((lineNodeA.y + lineNodeB.y)/2);
                
                var labelText = lineLable.getText();
                labelText.setText(calculateLineLength({
                	x1 : lineNodeA.x,
                	y1 : lineNodeA.y,
                	x2 : lineNodeB.x,
                	y2 : lineNodeB.y
                }));
                
                lineObj.setPoints([lineNodeA.x, lineNodeA.y, lineNodeB.x, lineNodeB.y]);
            });
    	}
    };
    
    /**
     * Update line after change node
     */
    var updateLineInfo = function(nodeObj,newX,newY){
    	nodeLines = nodeObj.getAttr('lines');
    	if(nodeLines.length > 0){
    		$.map(nodeLines,function(e,i){
                var lineObj = layer.find('#'+e)[0];
                var lineNodeA = lineObj.getAttr('nodeA');
                var lineNodeB = lineObj.getAttr('nodeB');
                if(lineNodeA.id==nodeObj.getId()){
                	lineNodeA.x = newX;
                	lineNodeA.y = newY;
                	lineObj.setAttr('nodeA',lineNodeA);
                } else {
                	lineNodeB.x = newX;
                	lineNodeB.y = newY;
                	lineObj.setAttr('nodeB',lineNodeB);
                }
                
                if(lineObj.getAttr('isGate')){
                	lineObj.setAttr('isGate',false);
                	var lineGateList = lineObj.getAttr('gateIdList');
                	while (lineGateList.length > 0) {
                		var gateObj = layer.find('#'+lineGateList.pop())[0];
                		layer.find('#'+gateObj.getAttr('endPointA'))[0].destroy();
                		layer.find('#'+gateObj.getAttr('endPointB'))[0].destroy();
                		gateObj.destroy();
                	}
                	lineObj.setAttr('gateIdList',[]);
                	calculateLineSublabel(e);
                }
                
                lineLable = layer.find('#'+lineObj.getAttr('label'))[0];                
                lineLable.setX((lineNodeA.x + lineNodeB.x)/2);
                lineLable.setY((lineNodeA.y + lineNodeB.y)/2);
                
                var labelText = lineLable.getText();
                labelText.setText(calculateLineLength({
                	x1 : lineNodeA.x,
                	y1 : lineNodeA.y,
                	x2 : lineNodeB.x,
                	y2 : lineNodeB.y
                }));
                
                lineObj.setPoints([lineNodeA.x, lineNodeA.y, lineNodeB.x, lineNodeB.y]);
            });
    	}
    };
    
    /**
     * Draw Gate after dropped
     */
    var dropGate = function(event,ui) {
    	var gateInfo = {
    		'gate_id' : ui.helper.attr('data-gate-id'),
    		'gate_type' : ui.helper.attr('data-gate-type'),
    		'gate_width' : ui.helper.attr('data-gate-width'),
    	};
    	
    	var rect = new Kinetic.Rect({
    		x: event.pageX - $(event.target).offset().left,
            y: event.pageY- $(event.target).offset().top,
            width: 40,
            height: 20,
            name : 'undropGate',
            id : 'undrop'+uniqueID(),
            fillRGB: { r:56, g:142, b:142 },
            strokeRGB : { r:47, g:79, b:79 },            
            draggable : true,
        });
        
        rect.on('mouseover',function(){            
            document.body.style.cursor = 'pointer';
            layer.drawScene();
        });   
       
        rect.on('mouseout',function(){            
            document.body.style.cursor = 'default';
            layer.drawScene();
        });
        
        rect.on('dblclick',function(evt){    	
            this.destroy();
            layer.draw();
        });
        
        rect.on('dragend',function(evt){    	
            
            var X = this.getX(),
                Y = this.getY(),
                W = this.getWidth(),
                H = this.getHeight();
            
            var intersectObj = checkGateDropOveLine(X,Y,W,H);
            
            if(intersectObj.hasOwnProperty('iPoints')){            	
            	if(intersectObj.iPoints.length==2){
            		updateLineAfterGateDrop(this.gateInfo,intersectObj);
            		this.remove();
            		this.destroy();
            		layer.drawScene();
                } 
            }
            
        });
        
        rect.gateInfo = gateInfo;
        
        layer.add(rect);
        layer.draw();
    };
    
    /**
     * Update image and its anchor
     */
    function updateImage(activeAnchor) {
    	var group = activeAnchor.getParent();

        var topLeft = group.get('.topLeft')[0];
        var topRight = group.get('.topRight')[0];
        var bottomRight = group.get('.bottomRight')[0];
        var bottomLeft = group.get('.bottomLeft')[0];
        var image = group.get('.structure')[0];

        var anchorX = activeAnchor.getX();
        var anchorY = activeAnchor.getY();

        // update anchor positions
        switch (activeAnchor.getName()) {
        	case 'topLeft':        		
        		topRight.setY(anchorY);
        		bottomLeft.setX(anchorX);
        		break;
        	case 'topRight':
        		topLeft.setY(anchorY);
        		bottomRight.setX(anchorX);
        		break;
        	case 'bottomRight':
        		bottomLeft.setY(anchorY);
        		topRight.setX(anchorX); 
        		break;
        	case 'bottomLeft':
	            bottomRight.setY(anchorY);
	            topLeft.setX(anchorX); 
	            break;
        }

        image.setPosition(topLeft.getPosition());

        var width = Math.abs(topRight.getX() - topLeft.getX());
        var height = Math.abs(bottomLeft.getY() - topLeft.getY());
        if(width && height) {
        	image.setSize(width, height);
        }
    }
    
    function addImageAnchor(group, x, y, name) {    	
        var glayer = group.getLayer();

        var anchor = new Kinetic.Circle({
        	x: x,
			y: y,
			stroke: '#666',
			fill: '#ddd',
			strokeWidth: 2,
			radius: 3,
			name: name,
			draggable: true,
			dragOnTop: false,
			visible : false,
			groupId : group.getId(),
        });

        anchor.on('dragmove', function() {
        	updateImage(this);
        	glayer.draw();
        });
        
        anchor.on('mousedown touchstart', function() {
          group.setDraggable(false);
          this.moveToTop();
        });
        
        anchor.on('dragend', function() {
          group.setDraggable(true);
          glayer.draw();
        });
        
        // add hover styling
        anchor.on('mouseover', function() {
          var glayer = this.getLayer();
          document.body.style.cursor = 'pointer';
          this.setStrokeWidth(5);
          glayer.draw();
        });
        
        anchor.on('mouseout', function() {
          var glayer = this.getLayer();
          document.body.style.cursor = 'default';
          this.setStrokeWidth(2);
          glayer.draw();
        });

        group.add(anchor);
        
        return anchor;
      };
    
    /**
     * Draw stucture after drooped
     */
    var drawStructure = function(imgObj, event, ui) {
    	
    	var img = $(ui.draggable).clone().find('img');
    	
    	var imageGroup = new Kinetic.Group({
            x: event.pageX - $(event.target).offset().left,
            y: event.pageY- $(event.target).offset().top,
            id : 'imgGrp'+uniqueID(),
            name : 'imgNav',
            draggable: true
        });
    	layer.add(imageGroup);
    	
    	var fillRGB = { r: 0, g: 0, b: 0};
    	switch($(ui.helper).attr('data-type')){
    		case 'house':
    			fillRGB = { r: 102, g: 102, b: 102 };
    			break;
    		case 'deck':
    			fillRGB = { r: 139, g: 115, b: 89 };
    			break;
    		case 'tree':
    			fillRGB = { r: 34, g: 139, b: 34 };
    			break;
    		case 'pool':
    			fillRGB = { r: 152, g: 245, b: 255 };
    			break;
    	}
    	var structure = new Object();
    	switch($(ui.helper).attr('data-type')){
	    	case 'house':			
			case 'deck':
			case 'pool':
				structure = new Kinetic.Rect({
		    		x: 0,
		            y: 0,
		            id : 'struct'+uniqueID(),
		            name : 'structure',
		            width: img[0].width,
		            height: img[0].height,
		            fillRGB: fillRGB,
		        });
				break;	
			case 'tree':
				structure = new Kinetic.Image({
		            image: imgObj,		            
		            name : 'structure',
		            id : 'struct'+uniqueID(),
		            x: 0,
		            y: 0,
		            width: img[0].width,
		            height: img[0].height,		            
		    	});
				break;
		
    	}
    	
    	/*var stucture = new Kinetic.Image({
            image: imgObj,
            fill : 'black',
            name : 'structure',
            id : 'struct'+uniqueID(),
            x: 0,
            y: 0,
            width: img[0].width,
            height: img[0].height,
            //draggable: true
    	});*/
    	
    	/*var stucture = new Kinetic.Rect({
    		x: 0,
            y: 0,
            id : 'struct'+uniqueID(),
            name : 'structure',
            width: img[0].width,
            height: img[0].height,
            fillRGB: fillRGB,
        });*/
    	
    	structure.setAttr('toggleClick', false);
    	
    	imageGroup.add(structure);
    	addImageAnchor(imageGroup, 0, 0, 'topLeft');
    	addImageAnchor(imageGroup, img[0].width, 0, 'topRight');
    	addImageAnchor(imageGroup, img[0].width, img[0].height, 'bottomRight');
    	addImageAnchor(imageGroup, 0, img[0].height, 'bottomLeft');
    	
    	structure.on('click', function(evt) {
    		var stID = this.getId();
    		var node = layer.find('#'+stID)[0];
    		var pNode = node.getParent();
    		
           if(node.getAttr('toggleClick')==true) {
        	   
        	   node.setAttr('toggleClick', false);
        	   node.setAttrs({
        		   stroke : 'transparent',
        		   strokeWidth : 2
        	   });
        	   pNode.find('.topLeft').hide();
        	   pNode.find('.topRight').hide();
        	   pNode.find('.bottomRight').hide();
        	   pNode.find('.bottomLeft').hide();
           } else {
        	   node.setAttr('toggleClick', true);
        	   node.setAttrs({
        		   stroke : 'gray',
        		   strokeWidth : 2
        	   });
        	   pNode.find('.topLeft').show();
        	   pNode.find('.topRight').show();
        	   pNode.find('.bottomRight').show();
        	   pNode.find('.bottomLeft').show();
           }
           layer.draw();
    	});
    	
    	structure.on('dblclick',function(){
    		this.getParent().destroy();
    		layer.drawScene();
    	});
    	
    	imageGroup.on('dragstart', function() {
            this.moveToTop();
        });
    	
    	layer.draw();
    	
    	_ObjectList.push({'type':'stucture', 'Obj':imageGroup});
    };
    
    /**
     * Handle drop stucture event
     */
    var dropStructure = function(event,ui) {
    	
    	var imageObj = new Image();
        imageObj.onload = function() {
          drawStructure(this,event,ui);
        };
        if($(ui.helper).attr('data-type')=='tree'){
        	imageObj.src = baseUrl+'/images/tree.png';
        } else {
        	imageObj.src = $(ui.draggable).clone().find('img').attr('src');
        }
    };
    
    /**
     * calculate 1ft in pixel
     */
    var getPerFeetInPixel = function(){
    	var canvasLength = (stage.getWidth() > 500 ) ? 500 : stage.getWidth();
        var drawingLength = $('#drawing_grid_length').val();
        var lengthRatio = canvasLength / drawingLength;
        
        return lengthRatio;
    };

    /**
     * Calculate Line length in canvas
     */
    var calculateLineLength = function(lineObj) {
        var length = Math.sqrt(Math.pow((lineObj.x1-lineObj.x2),2) + Math.pow((lineObj.y1-lineObj.y2),2));        
        length = length / getPerFeetInPixel();
        
        if(typeof length.toFixed(2) === 'number' && length.toFixed(2) % 1 === 0) {
        	return parseInt(length) +' ft';
        } else {
        	return Math.round(length)+' ft';        	
        }
    };
    
    /**
     * Calculate GateLength in Pixel / convert in feet to pixel
     */
    var calculateGateLengthInPixel = function(gateLength) {        
        return gateLength * getPerFeetInPixel();
    };
    
    /**
     * Re-calculate line width drawing grid length change
     */
    $('#drawing_grid_length').on('change',function(){    	
    	var lines = layer.find('.fence-line');
    	var gates = layer.find('.dropGate');
    	
    	$.map(gates,function(e,i){
    		var lineObj = layer.find('#'+e.getAttr('lineId'))[0];
    		var gateInfo = e.getAttr('gateInfo');
    		var slope = findSlope(lineObj.getPoints()[0].x, lineObj.getPoints()[0].y, lineObj.getPoints()[1].x, lineObj.getPoints()[1].y);
        	var c = findLineConstant(lineObj.getPoints()[0].x, lineObj.getPoints()[0].y, slope);
        	var r = calculateGateLengthInPixel(gateInfo.gate_width/2);
        	var gatePoints = findLineCircleIntersectPoints({m : slope, c : c}, {p : e.getAttr('gatePosition').x, q : e.getAttr('gatePosition').y, r : r});
        	
        	e.setPoints([gatePoints.x1, gatePoints.y1, gatePoints.x2, gatePoints.y2]);
        	var pointObjA = layer.find('#'+e.getAttr('endPointA'))[0];
        	var pointObjB = layer.find('#'+e.getAttr('endPointB'))[0];
        	pointObjA.setX(gatePoints.x1);
	    	pointObjA.setY(gatePoints.y1);
	    	pointObjB.setX(gatePoints.x2);
	    	pointObjB.setY(gatePoints.y2);
    	});
    	
    	$.map(lines,function(e,i){
    		var label = layer.find('#'+e.getAttr('label'))[0];
    		var labelText = label.getText();
            labelText.setText(calculateLineLength({
            	x1 : e.getPoints()[0].x,
            	y1 : e.getPoints()[0].y,
            	x2 : e.getPoints()[1].x,
            	y2 : e.getPoints()[1].y
            })); // Calculating Main Label
            
            calculateLineSublabel(e.getId()); // calculation Sub Label
        });
    	layer.drawScene();
    });
    
    /**
     * Update Gate if drop over line
     */
    var updateLineAfterGateDrop = function(gateInfo,intersectObj) {    	
    	
    	var aPoint = intersectObj.line.getAttr('nodeA');
    	var bPoint = intersectObj.line.getAttr('nodeB');
    	
    	var nx = (intersectObj.iPoints[0].x + intersectObj.iPoints[1].x) / 2;
    	var ny = (intersectObj.iPoints[0].y + intersectObj.iPoints[1].y) / 2;
    	
    	var slope = findSlope(aPoint.x, aPoint.y, bPoint.x, bPoint.y);
    	var c = findLineConstant(aPoint.x, aPoint.y, slope);
    	var r = calculateGateLengthInPixel(gateInfo.gate_width/2);
    	var gatePoints = findLineCircleIntersectPoints({m : slope, c : c}, {p : nx, q : ny, r : r});
    	
    	if(gatePoints.status==2){ 			
    		drawGate(gatePoints,intersectObj,{x:nx,y:ny},gateInfo);
    	}
    };
    
    /**
     * Make dragable fence structure without gate
     */
    $('.fence-structure').draggable({
        helper: 'clone',
        cursor: "move",
        zIndex: 100,
        cursorAt: { top: 10, left: 10 },
        revert: "invalid"
    });
    
    /**
     * Make dragable fence gate
     */
    $('.fence-gate').draggable({
    	helper: 'clone',
        cursor: "move",
        zIndex: 100,
        cursorAt: { top: 10, left: 10 },
        revert: "invalid"
    });
    
    var canvasContainer = stage.getContainer();
    var canvasElement = $(canvasContainer).find('canvas');
    
    /**
     * make canvas droppable
     */
    canvasElement.droppable({
    	accept: "a",
        drop: function(event,ui){        	
        	if($(ui.draggable).clone().hasClass('fence-structure')){
        		dropStructure(event,ui);
        	}
        	
        	if($(ui.draggable).clone().hasClass('fence-gate')){
        		dropGate(event,ui);
        	}
        }
    });
    
    $('#undo_btn').on('click',function(){
    	undo();
    });
    
    /**
     * canvas undo functionality
     */
    var undo = function() {
    	var obj = _ObjectList.pop();
    	
    	if($.isEmptyObject(obj)) return;
    	switch(obj.type) {
    		case 'line':
    			var lineObj = obj.Obj;
    			var lineId = lineObj.getId();
    			
    			var nodeA = layer.find('#'+lineObj.getAttr('nodeA').id)[0];
    			var nodeB = layer.find('#'+lineObj.getAttr('nodeB').id)[0];    			    			
    			
    			if(nodeA.getAttr('lines').length == 1){
    				nodeA.destroy();
    				nodeB.getAttr('adjNode').removeByValue(nodeA.getId());
    			} else {
    				nodeA.getAttr('lines').removeByValue(lineId);
    			}
    			
    			if(nodeB.getAttr('lines').length == 1){
    				nodeB.destroy();
    				nodeA.getAttr('adjNode').removeByValue(nodeA.getId());
    			} else {
    				nodeB.getAttr('lines').removeByValue(lineId);
    			}
    			    			
    			lineObj.destroy();
    			layer.find('#'+lineObj.getAttr('label'))[0].destroy();
    			
    			layer.draw();
    			break;
    		
    		case 'gate':
    			var pointA = layer.find('#'+obj.Obj.getAttr('endPointA'))[0];
    			var pointB = layer.find('#'+obj.Obj.getAttr('endPointB'))[0];
    			var kLine = layer.find('#'+obj.Obj.getAttr('lineId'))[0];
    			kLine.getAttr('gateIdList').removeByValue(obj.Obj.getId());
    			calculateLineSublabel(obj.Obj.getAttr('lineId'));
    			
    			pointA.destroy();
    			pointB.destroy();
    			obj.Obj.destroy();
    			layer.draw();
    			break;
    		
    		case 'stucture':
    			obj.Obj.destroy();
    			layer.draw();
    			break;   		
    	}    	
    	
    };
    
    
});


var clearCanvas = function(){	
	var canvasLayer = stage.find('#mainLayer')[0];
	function removeNode(nodeList){
		$.map(nodeList,function(e,i){
			e.destroy();			
		});
	}
	
	var nodeObjects = stage.find('.fence-line');
	$.map(nodeObjects,function(e,i){		
		e.destroy();
		var label = canvasLayer.find('#'+e.getAttr('label'));
		label.destroy();
		var subLabel = stage.find('.'+e.getAttr('sublabelClass'));
		removeNode(subLabel);
	});
	
	var nodeObjects = stage.find('.circle');
	removeNode(nodeObjects);
	
	var nodeObjects = stage.find('.gate_end_point');
	removeNode(nodeObjects);
	
	var nodeObjects = stage.find('.dropGate');
	removeNode(nodeObjects);
	
	var nodeObjects = stage.find('.undropGate');
	removeNode(nodeObjects);
	
	var nodeObjects = stage.find('.structure');
	removeNode(nodeObjects);
	
	var nodeObjects = stage.find('.imgNav');
	removeNode(nodeObjects);
	
	_ObjectList.length = 0;
	
	canvasLayer.draw();	
};

/**Graph function**/
var drawGraph = function(height, width){
    var group = new Kinetic.Group({
        id : 'graph-group',
        name : 'graph-group'
    });
   
    for(var i=0; i < height; i=i+10){
        var line = new Kinetic.Line({
            points: [0, i, width, i],
            stroke: 'white',
            name : 'graph-line',
            strokeWidth: 1,
        });   
        group.add(line);
    }
   
    for(var i=0; i < width; i=i+10){
        var line = new Kinetic.Line({
            points: [i, 0, i, height],
            stroke: 'white',
            name : 'graph-line',
            strokeWidth: 1,
        });
        group.add(line);
    }
   
    return group;
};

/**
 * Find intersect line point {x,y}
 * 
 * @param float x1,y1 and x2,y2 first line nodes
 * @param float x3,y3 and x4,y4 second line nodes
 */
var intersectLine = function (x1, y1, x2, y2, x3, y3, x4, y4) {
	var mmax = Math.max,
    	mmin = Math.min;
    if (
        mmax(x1, x2) < mmin(x3, x4) ||
        mmin(x1, x2) > mmax(x3, x4) ||
        mmax(y1, y2) < mmin(y3, y4) ||
        mmin(y1, y2) > mmax(y3, y4)
    ) {
        return;
    }
    var nx = (x1 * y2 - y1 * x2) * (x3 - x4) - (x1 - x2) * (x3 * y4 - y3 * x4),
        ny = (x1 * y2 - y1 * x2) * (y3 - y4) - (y1 - y2) * (x3 * y4 - y3 * x4),
        denominator = (x1 - x2) * (y3 - y4) - (y1 - y2) * (x3 - x4);

    if (!denominator) {
        return;
    }
    var px = nx / denominator,
        py = ny / denominator,
        px2 = +px.toFixed(2),
        py2 = +py.toFixed(2);
    if (
        px2 < +mmin(x1, x2).toFixed(2) ||
        px2 > +mmax(x1, x2).toFixed(2) ||
        px2 < +mmin(x3, x4).toFixed(2) ||
        px2 > +mmax(x3, x4).toFixed(2) ||
        py2 < +mmin(y1, y2).toFixed(2) ||
        py2 > +mmax(y1, y2).toFixed(2) ||
        py2 < +mmin(y3, y4).toFixed(2) ||
        py2 > +mmax(y3, y4).toFixed(2)
    ) {
        return;
    }
    return { x: px, y: py };
};

/**
 * Check and Return Gate over line
 * 
 * @params float X x-axis of rectangle
 * @params float Y y-axis of rectangle
 * @params float W width of rectangle
 * @params float H height of rectangle 
 */
var checkGateDropOveLine = function(X,Y,W,H) {
	
	var iLine = new Object();
	var lineObjects = stage.find('.fence-line');
	
    for(var i = 0; i < lineObjects.length; i++) {
    	var e = lineObjects[i];
    	
    	var icount=0,arms = new Array();
        var abArm = intersectLine(e.getPoints()[0].x,e.getPoints()[0].y,e.getPoints()[1].x,e.getPoints()[1].y,X,Y,X+W,Y);
        var bcArm = intersectLine(e.getPoints()[0].x,e.getPoints()[0].y,e.getPoints()[1].x,e.getPoints()[1].y,X+W,Y,X+W,Y+H);
        var dcArm = intersectLine(e.getPoints()[0].x,e.getPoints()[0].y,e.getPoints()[1].x,e.getPoints()[1].y,X,Y+H,X+W,Y+H);
        var adArm = intersectLine(e.getPoints()[0].x,e.getPoints()[0].y,e.getPoints()[1].x,e.getPoints()[1].y,X,Y,X,Y+H);
        
        if(!$.isEmptyObject(abArm)){
        	arms.push(abArm);            	
        	icount++;
        }
        
        if(!$.isEmptyObject(bcArm)){
        	arms.push(bcArm);            	
        	icount++;
        }
        
        if(!$.isEmptyObject(dcArm)){
        	arms.push(dcArm);            	
        	icount++;
        }
        
        if(!$.isEmptyObject(adArm)){
        	arms.push(adArm);
        	icount++;
        }
        
        if(icount==2){
        	iLine = {
        		line : e,
        		iPoints : arms
        	};        	
        	break;
        }
    }
    
    return iLine;
    
};

/**
 * Find line slope{m - slope of line}
 * { y = (y1-y2)/(x1-x2) }
 * 
 * @param float x1 first x-axis point
 * @param float y1 first y-axis point
 * @param float x2 second x-axis point
 * @param float y2 second y-axis point
 */
var findSlope = function(x1,y1,x2,y2){
	if(x1 == x2) return 'v';
	
	return ( ( y1 - y2 ) / ( x1 - x2 ));
};


/**
 * find line Constant{c - constant of line}
 * { c = y - m*x }
 * 
 * @param float x x-axis point
 * @param float y y-axis point
 * @param float m slope of line
 */
var findLineConstant = function(x,y,m) {	
	if(m == 'v') return 'v';
	
	return (y - (m * x));
};

/**
 * find Line and Circle intersection point/points and status{x1,y1,x2,y2}
 * { y = mx + c and (x-p)^2 + (y-q)^2 = r^2 }
 * 
 * @param Object line { m, c - slope and constant }
 * @param Object circle { p, q, r - center and radius}
 */
var findLineCircleIntersectPoints = function(line,circle) {
	var x1, x2, y1, y2;
	if(line.m == 'v') {
		x1 = circle.p;
		x2 = circle.p;
		y1 = circle.q - circle.r;
		y2 = circle.q + circle.r;
		
		return { x1 : x1, y1 : y1, x2 : x2, y2 : y2, status : 2};
	}
	
	var A = Math.pow(line.m,2) + 1;
	var B = 2 * ((line.m * (line.c - circle.q)) - circle.p);
	var C = Math.pow(circle.q,2) - Math.pow(circle.r,2) + Math.pow(circle.p,2) - (2 * line.c * circle.q) + Math.pow(line.c,2);
	
	var circleStatus = Math.pow(B,2) - (4 * A * C);
	
	if(circleStatus > 0) {
		x1 = (-B + Math.sqrt(circleStatus)) / (2 * A);
		x2 = (-B - Math.sqrt(circleStatus)) / (2 * A);
		
		y1 = (line.m * x1) + line.c;
		y2 = (line.m * x2) + line.c;
		
		return { x1 : x1, y1 : y1, x2 : x2, y2 : y2, status : 2};
	} else if(circleStatus == 0) {
		return { status : 1 };
	} else {
		return { status : 0 };
	}
};

/**
 * Calculate points distance
 */
var calculateLineDistance = function(x1,y1,x2,y2){
	return Math.sqrt(Math.pow((x1-x2),2) + Math.pow((y1-y2),2));
};

/**
 * Find angle of two lines. given 3 points
 * center point and other two points
 *
 * @param centerPoint
 * @param pointOne
 * @param pointTwo
 */
var calculateAngleTwoLines = function(pointOne, pointTwo, centerPoint){
    console.log(pointOne);
    console.log(pointTwo);
    console.log(centerPoint);

    var p0c = Math.sqrt(Math.pow(centerPoint.x-pointOne.x,2) + Math.pow(centerPoint.y-pointOne.y,2)),
    p1c = Math.sqrt(Math.pow(centerPoint.x-pointTwo.x,2) + Math.pow(centerPoint.y-pointTwo.y,2)),
    p0p1 = Math.sqrt(Math.pow(pointTwo.x-pointOne.x,2) + Math.pow(pointTwo.y-pointOne.y,2));

    return Math.acos(( p1c*p1c + p0c*p0c - p0p1*p0p1 )/(2 * p1c * p0c));
}

/**
 *
 * @param lineIDone
 * @param lineIDtwo
 *
 * @return angle in degree
 */
var getAngleFromTwoLines = function(lineIDone, lineIDtwo){
    var point,
        objectPoints = [],
        pointOne,
        pointTwo,
        pointCenter,
        angle,
        isDuplicate = false;
    var lineOneObj = stage.find('#'+lineIDone)[0],
        lineTwoObj = stage.find('#'+lineIDtwo)[0];

    point = lineOneObj.getAttr('points');
    objectPoints.push(point[0]);
    objectPoints.push(point[1]);

    point = lineTwoObj.getAttr('points');
    objectPoints.push(point[0]);
    objectPoints.push(point[1]);

    for( var i = 0; i < objectPoints.length; i++){
        isDuplicate = false;
        for( var j = i+1; j < objectPoints.length; j++){
            if( objectPoints[j].x == objectPoints[i].x && objectPoints[j].y == objectPoints[i].y ){
                objectPoints.splice(j,1);
                --j;
                isDuplicate = true;
                pointCenter = { x: objectPoints[i].x, y : objectPoints[i].y };
            }
        }

        if(isDuplicate==true) {
            objectPoints.splice(i,1);
            --i;
        }

    }

    pointOne = { x : objectPoints[0].x, y : objectPoints[0].y };
    pointTwo = { x : objectPoints[1].x, y : objectPoints[1].y };

    angle = calculateAngleTwoLines(pointOne, pointTwo, pointCenter);

    return (angle * ( 180 / Math.PI ));

};

/**
 * Remove Object by obeject id from array
 * @param value
 * @returns {Array}
 */
Array.prototype.removeByObjectID = function(value) {
	for (var i = 0; i < this.length; i++) {
        if (this[i].id === value) {
            this.splice(i, 1);
            i--;
        }
    }
    return this;	
};

/**
 * Remove value by value from array
 * @param value
 * @returns {Array}
 */
Array.prototype.removeByValue = function(value) {
	var i = this.indexOf(value);
	if(i != -1) {
		this.splice(i, 1);
	}
	
	return this;
};

/**
 * Make array with uniqe element
 * @returns {Array}
 */
Array.prototype.getUnique = function(){
   var u = {}, a = [];
   for(var i = 0, l = this.length; i < l; ++i){
      if(u.hasOwnProperty(this[i])) {
         continue;
      }
      a.push(this[i]);
      u[this[i]] = 1;
   }
   return a;
};
