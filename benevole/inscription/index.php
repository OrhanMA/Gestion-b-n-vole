<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription pour bénévoles</title>
  <link rel="stylesheet" href="../../styles/style.css">
</head>

<body>

  <h1>Page d'inscription bénévole</h1>
  <p>Remplissez le formulaire afin de créer votre profil de bénévole.</p>
  <form id="form" action="./sign_up.php" method="post">
    <div class="form_part form_1">
      <caption>Formulaire 1/3</caption>
      <div class="form_field_container">
        <label for="first_name">Prénom</label>
        <input required type="text" name="first_name" id="first_name" minlength="3" maxlength="30" value="David">
      </div>
      <div class="form_field_container">
        <label for="last_name">Nom de famille</label>
        <input required type="text" name="last_name" id="last_name" minlength="3" maxlength="30" value="OUUIUUAIIISIS">
      </div>
      <div class="form_field_container">
        <label for="age">Âge</label>
        <input required type="number" name="age" id="age" min="18" max="45" value="30">
      </div>
      <div class="form_field_container">
        <label for="genre">Sexe</label>
        <select required name="genre" id="genre">
          <option value="femme">Femme</option>
          <option value="homme">Homme</option>
          <option value="secret">Non spécifié</option>
        </select>
      </div>
      <div class="form_field_container">
        <label for="phone">N° téléphone</label>
        <input required type="tel" name="phone" id="phone" value="0623456789" pattern="^(06|07)\d{8}$">
      </div>
      <div class="form_field_container">
        <label for="email">Adresse email</label>
        <input required type="email" name="email" id="email" value="test@test.com">
      </div>
      <button class="suivant button-accent" type="button">Suivant</button>
    </div>
    <div class="form_part form_2">
      <caption>Formulaire 2/3</caption>
      <div class="form_field_container">
        <label for="region">Région</label>
        <select required name="region" id="region">
          <option value="Auvergne-Rhône-Alpes">Auvergne-Rhône-Alpes</option>
          <option value="Bourgogne-Franche-Comté">Bourgogne-Franche-Comté</option>
          <option value="Bretagne">Bretagne</option>
          <option value="Centre-Val-de-loire">Centre-Val de Loire</option>
          <option value="Corse">Corse</option>
          <option value="Grand-Est">Grand Est</option>
          <option value="Hauts-de-France">Hauts-de-France</option>
          <option value="Île-de-France">Île-de-France</option>
          <option value="Normandie">Normandie</option>
          <option value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
          <option value="Occitanie">Occitanie</option>
          <option value="Pays-de-la-loire">Pays de la Loire</option>
          <option value="Provence-Alpes-Côte-d-azure">Provence Alpes Côte d'azure</option>
        </select>
      </div>
      <div class="form_field_container">
        <label for="dispo_jour">Disponiblité jour</label>
        <select required name="dispo_jour" id="dispo_jour">
          <option value="semaine">semaine</option>
          <option value="weekend">weekend</option>
        </select>
      </div>
      <div class="form_field_container">
        <label for="dispo_horaire">Disponiblité horaire</label>
        <select required name="dispo_horaire" id="dispo_horaire">
          <option value="matin">matin</option>
          <option value="apres-midi">après-midi</option>
          <option value="soir">soir</option>
          <option value="nuit">nuit</option>
        </select>
      </div>
      <div class="form_field_container">
        <label for="poste">Poste privilégié</label>
        <select name="poste" id="poste">
          <option value="sécurité">sécurité</option>
          <option value="bar">bar</option>
          <option value="technique">technique</option>
          <option value="animation">animation</option>
        </select>
      </div>
      <button class="suivant button-accent" type="button">Suivant</button>
    </div>
    <div class="form_part form_3">
      <caption>Formulaire 3/3</caption>
      <div class="form_field_container">
        <label for="message">Laissez un message libre</label>
        <textarea required name="message" id="message" cols="30" rows="10" minlength="30" maxlength="500">orrboinzrbonrzobnzrobnrzobnzrobnzroibnzrobnzroinbzoinornzroinrz</textarea>
        <input type="submit" class="button-accent" value="Valider mon inscription">
      </div>
    </div>
  </form>
  <script defer>
    // récupère tous les formulaires du document
    const forms_parts = document.querySelectorAll('.form_part');
    // récupère les paramètres d'URL
    const urlParams = new URLSearchParams(window.location.search);

    // Récupère le paramètre d'étape du formulaire
    const step = urlParams.get('step');
    let step_number = Number(step) || 1;
    console.log(step_number);

    const buttons_suivant = document.querySelectorAll('.suivant');
    // console.log(buttons_suivant);

    buttons_suivant.forEach((button) => {
      button.addEventListener('click', () => {
        if (step_number === 1) {
          const fields = getAllFormPartFields('form_1');
          const fields_valid = checkFieldsValidity(fields);
          if (fields_valid === true) {
            displayFormPart('form_2');
            step_number++;
          }
        } else if (step_number === 2) {
          const fields = getAllFormPartFields('form_2');
          const fields_valid = checkFieldsValidity(fields);
          if (fields_valid === true) {
            displayFormPart('form_3');
            step_number++;
          }
        } else {
          return;
        }
      })
    })
    toggleFormDisplay(step);

    function toggleFormDisplay(step) {
      if (step) {
        // pour chaque formulaire, si son ID correspond à l'étape actuelle, affiche le, sinon cache le.
        if (step === "") {
          // console.log('step empty');
          displayFormPart('form_1');
        } else {
          const form_class = 'form_' + step.toString();
          displayFormPart(form_class);
        }
      } else {
        displayFormPart('form_1');
      }
    }

    function displayFormPart(form_class) {
      forms_parts.forEach(form => {
        // console.log(form_class);
        if (form.classList.contains(form_class)) {
          form.style.display = 'flex';
        } else {
          form.style.display = 'none';
        }
      });
    }

    function getAllFormPartFields(form_part_class) {
      const parent = document.querySelector("." + form_part_class);
      const fields = parent.querySelectorAll("input, select, textarea");
      return fields;
    }

    function checkFieldsValidity(fields) {
      let all_fields_valid = true;

      fields.forEach((field) => {
        console.log(field.validity.valid);
        // console.log(field.validity.typeMismatch);
        if (!field.validity.valid) {
          all_fields_valid = false;

          console.log(field.name);
          alert(`${field.name} is not valid`);
        }
      })
      return all_fields_valid;
    }
  </script>

</body>

</html>