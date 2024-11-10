

  const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
    
    const item = document.createElement('li');
    item.className = 'list-group-item ';
  
    item.innerHTML = collectionHolder
      .dataset
      .prototype
      .replace(
        /__name__/g,
        collectionHolder.dataset.index
      );
  
    collectionHolder.appendChild(item);
    let searchId = collectionHolder.appendChild(item).lastChild.lastChild.lastChild.getAttribute('id');
    let tgs = document.getElementsByClassName('addTag');
    for(let i =0; i< tgs.length; i++){
     tgs[i].onclick = function(){ 
      
      document.getElementById(searchId).innerHTML = this.innerText; 
        console.log(searchId);
        console.log(this.innerText);
     } 
    }
    console.log(collectionHolder.appendChild(item).lastChild.lastChild.lastChild.getAttribute('id'));
  };

  document
  .querySelectorAll('.add_item_link')
  .forEach(btn => btn.addEventListener("click", addFormToCollection));
  
  
  
  // document.getElementById(idText + "-id").innerHTML = text;  
  
  // document.querySelector(".addTag").onclick=function(){
  //   let idText = this.innerText;
  //   console.log(idText);
  // }

 
  