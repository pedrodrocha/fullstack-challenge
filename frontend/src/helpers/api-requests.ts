import axios from "axios";
import type { AxiosResponse } from "axios";

export async function getUserProfiles(): Promise<AxiosResponse<any, any>> {
    const url = 'http://localhost/'
    
    return await axios.get(url)

}

export async function getUserWeather(id: Number, new_retrieval: boolean): Promise<AxiosResponse<any, any>> {
    const url = 'http://localhost/users/weather/' + id

    return await axios({
        method: 'get',
        url: url,
        params: {
          refresh: new_retrieval ? 'refresh' : null
        }
      });
}