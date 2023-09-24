<style>
    /* Custom Navigation */
.custom-nav {
  background-color: #F1E8E6;
  padding: 10px;
  display: flex;
  flex-direction: column; /* Change to column layout for small screens */
  align-items: center;
  text-align: center; /* Center text on small screens */
}


.options {
  display: flex;
  flex-direction: column; /* Change to column layout for small screens */
  gap: 20px;
}

.dropdown {
  display: flex;
  flex-direction: column;
  margin-bottom: 10px;
}

.dropdown label {
  font-weight: bold;
}





/* Responsive Design */
@media screen and (max-width: 768px) {
  /* Adjust custom navigation layout for medium-sized screens */
  .custom-nav {
      flex-direction: row;
      align-items: flex-start;
      text-align: left; /* Reset text alignment for medium screens */
  }



  .options {
      flex-direction: row;
      /* margin-left: auto; */
  }

  .dropdown {
      margin-bottom: 0;
      margin-right: 20px;
  }
  


}

@media screen and (min-width: 992px) {
  /* Adjust custom navigation layout for large screens */
  .custom-nav {
      flex-direction: row;
  }


}
</style>

<main>
        <div class="custom-nav">
            <!-- <div class="path">
                Home / Categories / Lace Wigs / HD Brazilian Lace Wigs
            </div> -->
            <div class="options">
                <div class="dropdown">
                    <label for="texture">Texture:</label>
                    <select id="texture">
                        <option value="straight">Straight</option>
                        <option value="wavy">Wavy</option>
                        <option value="curly">Curly</option>
                    </select>
                </div>
                <div class="dropdown">
                    <label for="color">Color:</label>
                    <select id="color">
                        <option value="black">Black</option>
                        <option value="brown">Brown</option>
                        <option value="blonde">Blonde</option>
                    </select>
                </div>
                <!-- Add more dropdowns as needed -->
            </div>
        </div>
    