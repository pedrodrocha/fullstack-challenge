import axios from "axios";
import type { AxiosResponse } from "axios";

export async function getUserProfiles(): Promise<AxiosResponse<any, any>> {
  const url = "http://localhost/";

  return await axios.get(url);
}

export async function getUserWeather(
  id: Number,
  newRetrieval: boolean
): Promise<AxiosResponse<any, any>> {
  const url = `http://localhost/users/weather/${id}`;
  const params = newRetrieval ? { refresh: "refresh" } : null;

  return await axios.get(url, { params });
}
