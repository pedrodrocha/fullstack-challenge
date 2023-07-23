import axios from "axios";

export async function getUserProfiles(url: string) {
    let response = await axios.get(url)

    if (response.status) {
        return response.data.users
    }

    return false

}

export async function getUserWeather(url: string) {
    let response = await axios.get(url)

    if (response.status === 200 && response.data.success) {
        return response.data
    }

    return false
}