import { Dropdown } from "flowbite";

window.aksi_kandidat = function (id) {
    document.getElementById("user-dropdown-button" + id);
};

window.aksi_user = function (user_id) {
    try {
        let userDropdown = document.getElementById("user-dropdown");
        let drop_trigger = document.getElementById(
            "user-dropdown-button" + user_id
        );
        let instanceOptions = {
            id: "user-dropdown",
            override: true,
        };
        let dropdown = new Dropdown(
            userDropdown,
            drop_trigger,
            instanceOptions
        );
        dropdown.show();
        const btn = document.getElementById("user-dropdown-button" + user_id);
        document.getElementById("update_nis").value = data(btn, "nis");
        document.getElementById("update_name").value = data(btn, "name");
        document.getElementById("username").innerHTML = data(btn, "name");

        document.getElementById("user_delete_form").action =
            "/dashboard/users/delete/" + user_id;

        document.getElementById("update_kelas").value = data(btn, "kelas");
        document.getElementById("updateUserForm").action =
            "/dashboard/users/update/" + user_id;
        document.getElementById("update_password").value = data(btn, "sandi");
        document.getElementById("update_role").value = data(btn, "role");
    } catch (error) {
        toastr.error(error);
    }
};
