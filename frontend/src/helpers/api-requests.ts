import axios from "axios";

export async function getUserProfiles(url: string) {
    let response = await axios.get(url)

    if (response.status) {
        return response.data.users
    }

}