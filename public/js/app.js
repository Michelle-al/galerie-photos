

  const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
  
    const item = document.createElement('li');
    item.className = 'list-group-item d-flex justify-content-between align-items-center row';
  
    item.innerHTML = collectionHolder
      .dataset
      .prototype
      .replace(
        /__name__/g,
        collectionHolder.dataset.index
      );
  
    collectionHolder.appendChild(item);
  
    collectionHolder.dataset.index++;
  };

  document
  .querySelectorAll('.add_item_link')
  .forEach(btn => btn.addEventListener("click", addFormToCollection));
  