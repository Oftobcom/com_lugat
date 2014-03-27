function CharsTJ(x) {
 var valor = x;
 var elemento_dom=document.getElementById('SearchWord');
 if(document.selection){
  elemento_dom.focus();
  sel=document.selection.createRange();
  sel.text=valor;
  return;
 }if(elemento_dom.selectionStart||elemento_dom.selectionStart=="0"){
  var t_start=elemento_dom.selectionStart;
  var t_end=elemento_dom.selectionEnd;
  var val_start=elemento_dom.value.substring(0,t_start);
  var val_end=elemento_dom.value.substring(t_end,elemento_dom.value.length);
  elemento_dom.value=val_start+valor+val_end;
 }else{
  elemento_dom.value+=valor;
 }
 elemento_dom.focus();
}